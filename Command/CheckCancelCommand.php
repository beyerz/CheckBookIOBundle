<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 15/12/2016
 * Time: 10:50
 */

namespace Beyerz\CheckBookIOBundle\Command;


use Beyerz\CheckBookIOBundle\Entity\Oauth;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CheckCancelCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('checkbook:check:cancel')
            ->setDescription("Cancel an existing check")
            ->addArgument('id', InputOption::VALUE_REQUIRED, 'Check Id')
            ->addOption('access_token', 'a', InputOption::VALUE_OPTIONAL, "If querying on behalf of a user with Oauth, provide the access_token",null)
            ->setHelp(<<<'EOF'
            The <info>%command.name%</info> command is used to cancel an existing check
EOF
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("Cancel Check");
        $checkbook = $this->getContainer()->get('checkbook.model');
        if(is_null($input->getOption('access_token'))) {
            $result = $checkbook->check()->cancel($input->getArgument('id'));
        }else{
            $oauth = new Oauth();
            $oauth->setAccessToken($input->getOption('access_token'));
            $result = $checkbook->oauth()->check($oauth)->cancel($input->getArgument('id'));
        }

        if($result->getHeaders()['Status-Code'] == 200) {
            $io->success('SUCCESS!');
            exit(0);
        }
        $io->error('FAILURE!');
        exit(1);
    }
}