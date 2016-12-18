<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 15/12/2016
 * Time: 10:50
 */

namespace Beyerz\CheckBookIOBundle\Command;


use Beyerz\CheckBookIOBundle\Model\Check\CreateCheckEntity;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CheckCreateCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('checkbook:check:create')
            ->setDescription("Create a new check")
            ->addArgument('amount', InputOption::VALUE_REQUIRED, 'Amount for check')
            ->addArgument('recipient', InputOption::VALUE_REQUIRED, 'Recipient’s email address')
            ->addOption('business', 'b', InputOption::VALUE_OPTIONAL, 'Recipient\'s business name')
            ->addOption('check_number', 'c', InputOption::VALUE_OPTIONAL, 'Check number for check')
            ->addOption('description', 'd', InputOption::VALUE_OPTIONAL, 'Message to appear in the memo field')
            ->addOption('first_name', 'f', InputOption::VALUE_OPTIONAL, 'Recipient’s first name')
            ->addOption('last_name', 'l', InputOption::VALUE_OPTIONAL, 'Recipient’s last name')
            ->setHelp(<<<'EOF'
            The <info>%command.name%</info> command is used create to new checks that may be sent to either an individual or a business.
            If the check is sent to an individual, the first_name and last_name fields must be populated.
            Otherwise, the first_name and last_name fields can be omitted, and the business field must be populated.

            If the sender wishes to set the check number on the check, a number can be passed in using the check_number field.
            Otherwise, we will begin numbering checks at 1001 (and will increment the number for each successive check).
EOF
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("Create Check");
        //validate that atleast business or first_name and last_name are set
        if(is_null($input->getOption('business')) && (is_null($input->getOption('first_name')) || is_null($input->getOption('last_name')))){
            throw new \InvalidArgumentException(<<<'EOF'
If sending checks to an individual, first_name and last name are required and business is omitted.
If sending checks to a business, business is required and first_name and last name are omitted.
Also all the name fields i.e. first_name, last_name and business_name cannot be NULL and must have atleast 2 characters if they are present.
EOF
);
        }
        $entity = new CreateCheckEntity();
        $entity->setAmount($input->getArgument('amount'))
            ->setRecipient($input->getArgument('recipient'))
            ->setBusiness($input->getOption('business'))
            ->setCheckNumber($input->getOption('check_number'))
            ->setDescription($input->getOption('description'))
            ->setFirstName($input->getOption('first_name'))
            ->setLastName($input->getOption('last_name'));

        $checkbook = $this->getContainer()->get('checkbook.model');
        $check = $checkbook->check()->create($entity);

        $headers = array_keys($check->serialize());
        $serialized = $check->serialize();
        $io->table($headers, [$serialized]);
    }
}