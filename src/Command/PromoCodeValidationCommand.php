<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PromoCodeValidationCommand extends Command
{
    protected static $defaultName = 'promo-code:validate';

    protected function configure()
    {
        $this
            ->setDescription("check the validity of a promo code.")
            ->setHelp("This Command allow you to check if a promo code is still valid or not , and link to offers.")
            ->addArgument('code',  InputArgument::REQUIRED, 'promo code to check')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $code = $input->getArgument('code');

        // We assume that a promo code have at least 6 characters ( alphanumeric, special characters)
        if(empty($code) || !preg_match("/^[\w@#&!$%£-]{6,}$/", $code)) {
            $output->writeln("promo code is empty or malformed");
            return Command::FAILURE;
        }

        //TODO: Entities Offer et Promocode & Serialization
        //TODO: Factory for instantiation API Offer ou promoCode
        //TODO: 2 services extends abstract class et implement interface
        //TODO: Service to check if Promocode exist in API
        //TODO: Service to check if an offre is linked
        //TODO: Use Pattern strategy for writer
        //TODO: Service to transforme data in json and write in file (Writer Abstract class and)

        return Command::SUCCESS;
    }

}