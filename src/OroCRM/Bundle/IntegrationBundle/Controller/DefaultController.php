<?php

namespace OroCRM\Bundle\IntegrationBundle\Controller;

use OroCRM\Bundle\IntegrationBundle\Provider\ChannelTypeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use OroCRM\Bundle\IntegrationBundle\Provider\Magento\MageCustomerConnector;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        /** @var $item ChannelTypeInterface */
        $channel = $this->getDoctrine()
            ->getRepository('OroCRMIntegrationBundle:ChannelType')->findBy(['name' => $name]);

        /** @var MageCustomerConnector $customerConnector */
        $customerConnector = $this->get('oro_integration.mage.customer_connector')
            ->setChannel($channel);

        $customerData = $customerConnector->getCustomerData();

        return [
            'name' => $name,
            'customerData' => $customerData,
        ];
    }
}
