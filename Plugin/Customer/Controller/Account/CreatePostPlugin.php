<?php

namespace Debuconnor\Honeypot\Plugin\Customer\Controller\Account;

use Magento\Customer\Controller\Account\CreatePost;
use Debuconnor\Honeypot\Helper\Data;
use Psr\Log\LoggerInterface;

class CreatePostPlugin{
    protected $helper;
    protected $logger;

    public function __construct(
        Data $helper,
        LoggerInterface $logger
    ){
        $this->helper = $helper;
        $this->logger = $logger;
    }

    public function aroundExecute(CreatePost $subject, callable $proceed){
        $data = $subject->getRequest()->getPost();
        
        $email = $data['email'];
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        
        $this->helper->isNameAllowed($firstname, $lastname);

        return $proceed();
    }
}