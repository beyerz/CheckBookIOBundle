<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 15/12/2016
 * Time: 10:50
 */

namespace Beyerz\CheckBookIOBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CheckCreateCommand extends ContainerAwareCommand
{

    protected function configure(){
        $this->setName('checkbook:check:create')
            ->setDescription("Create a new check")
            ->addOption('amount','a',InputOption::VALUE_REQUIRED,'Amount for check')
            ->addOption('business','b',InputOption::VALUE_OPTIONAL,'Recipient\'s business name')
            ->addOption('check_number','c',InputOption::VALUE_OPTIONAL,'Check number for check')
            ->addOption('description','d',InputOption::VALUE_OPTIONAL,'Message to appear in the memo field')
            ->addOption('first_name','f',InputOption::VALUE_OPTIONAL,'Recipient’s first name')
            ->addOption('last_name','l',InputOption::VALUE_OPTIONAL,'Recipient’s last name')
            ->addOption('recipient','r',InputOption::VALUE_REQUIRED,'Recipient’s email address')
            ->setHelp(<<<'EOF'
            The <info>%command.name%</info> command is used create to new checks that may be sent to either an individual or a business.
            If the check is sent to an individual, the first_name and last_name fields must be populated.
            Otherwise, the first_name and last_name fields can be omitted, and the business field must be populated.

            If the sender wishes to set the check number on the check, a number can be passed in using the check_number field.
            Otherwise, we will begin numbering checks at 1001 (and will increment the number for each successive check).
EOF
            );
    }

    public function execute(InputInterface $input, OutputInterface $output){

    }
}