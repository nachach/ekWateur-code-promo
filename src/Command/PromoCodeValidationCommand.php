<?php

namespace App\Command;

use App\Service\OfferManager;
use App\Service\PromoCodeManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PromoCodeValidationCommand extends Command
{
    protected static $defaultName = 'promo-code:validate';

    /** @var OfferManager */
    protected $offerManager;

    /** @var PromoCodeManager */
    protected $promoCodeManager;

    public function __construct(OfferManager $offerManager, PromoCodeManager $promoCodeManager)
    {
        parent::__construct();

        $this->offerManager = $offerManager;
        $this->promoCodeManager = $promoCodeManager;
    }


    protected function configure()
    {
        $this
            ->setDescription("check the validity of a promo code.")
            ->setHelp("This Command allow you to check if a promo code is still valid or not , and link to offers.")
            ->addArgument('code',  InputArgument::REQUIRED, 'promo code to check')
            ->addOption('writer', 'w',  InputOption::VALUE_OPTIONAL, 'writer (console, file or database)', "file")
            ->addOption('formater', 'f',  InputOption::VALUE_OPTIONAL, 'formater (json, text, xml)', "json")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $code = $input->getArgument('code');
        $writerOption = $input->getOption('writer');
        $formaterOption = $input->getOption('formater');

        // We assume that a promo code have at least 6 characters ( alphanumeric, special characters)
        if(empty($code) || !preg_match("/^[\w@#&!$%£-]{6,}$/", $code)) {
            $output->writeln("promo code is empty or malformed");
            return Command::FAILURE;
        }

        // We can use Factory for instantiation API Offer or promoCode if we want.
        $promoCodes = $this->promoCodeManager->loadFromApi();
        $offers = $this->offerManager->loadFromApi();

        if (!array_key_exists($code, $promoCodes)) {
            $output->writeln(sprintf("Promo code : %s does not exit", $code));
            return Command::FAILURE;
        }

        $selectedPromoCode = $promoCodes[$code];
        if (!$selectedPromoCode->isValid()) {
            $output->writeln(sprintf("Promo code : %s is not valid anymore", $code));
            return Command::FAILURE;
        }

        $validOffers = $this->offerManager->findLinkedOffers($selectedPromoCode, $offers);
        if (empty($validOffers["compatibleOfferList"])) {
            $output->writeln(sprintf("Any offer linked to Promo code : %s", $code));
            return Command::FAILURE;
        }


        $writerClass = sprintf("App\Service\Writer\%sWriter", ucwords($writerOption));
        $formaterClass = sprintf("App\Service\Formater\%sFormater", strtoupper($formaterOption));
        $writer = new $writerClass(new $formaterClass(), "/tmp/result.json");
        $outputData = $writer->write($validOffers);

        $output->writeln($outputData);
        $output->writeln(sprintf("%s Valid Offer(s) exported in %s on %s format", count($validOffers["compatibleOfferList"]), ucwords($writerOption), ucwords($formaterOption)));
        return Command::SUCCESS;
    }

}