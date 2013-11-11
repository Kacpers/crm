<?php

namespace OroCRM\Bundle\ReportBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Oro\Bundle\SecurityBundle\Annotation\Acl;

class ReportController extends Controller
{
    /**
     * @Route(
     *      "/{reportGroupName}/{reportName}/{_format}",
     *      name="orocrm_report_index",
     *      requirements={"reportGroupName"="\w+", "reportName"="\w+", "_format"="html|json"},
     *      defaults={"_format" = "html"}
     * )
     * @Template()
     * @Acl(
     *      id="orocrm_reports",
     *      type="action",
     *      label="Reports",
     *      group_name=""
     * )
     */
    public function indexAction($reportGroupName, $reportName)
    {
        $gridName  = implode('-', ['orocrm_report', $reportGroupName, $reportName]);
        $pageTitle = $this->get('oro_datagrid.datagrid.manager')->getConfigurationForGrid($gridName)['pageTitle'];

        $this->get('oro_navigation.title_service')->setParams(array('%reportName%' => $pageTitle));

        return [
            'pageTitle' => $pageTitle,
            'gridName'  => $gridName,
            'params'    => [
                'reportGroupName' => $reportGroupName,
                'reportName'      => $reportName
            ]
        ];
    }
}
