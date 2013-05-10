<?php

namespace Oro\Bundle\ContactBundle\Controller\Api\Rest;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Oro\Bundle\UserBundle\Annotation\Acl;
use Oro\Bundle\UserBundle\Annotation\AclAncestor;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Oro\Bundle\SoapBundle\Form\Handler\ApiFormHandler;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;
use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;

/**
 * @RouteResource("contactgroup")
 * @NamePrefix("oro_api_")
 */
class GroupController extends RestController implements ClassResourceInterface
{
    /**
     * REST GET list
     *
     * @QueryParam(name="page", requirements="\d+", nullable=true, description="Page number, starting from 1. Defaults to 1.")
     * @QueryParam(name="limit", requirements="\d+", nullable=true, description="Number of items per page. defaults to 10.")
     * @ApiDoc(
     *      description="Get all contact group items",
     *      resource=true
     * )
     * @AclAncestor("oro_contact_group_list")
     * @return Response
     */
    public function cgetAction()
    {
        return $this->handleGetListRequest();
    }

    /**
     * REST GET item
     *
     * @param string $id
     *
     * @ApiDoc(
     *      description="Get contact item",
     *      resource=true
     * )
     * @Acl(
     *      id="oro_contact_group_view",
     *      name="View contact group",
     *      description="View contact group",
     *      parent="oro_contact_group"
     * )
     * @return Response
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * REST PUT
     *
     * @param int $id
     *
     * @ApiDoc(
     *      description="Update contact group",
     *      resource=true
     * )
     * @AclAncestor("oro_contact_group_update")
     * @return Response
     */
    public function putAction($id)
    {
        return $this->handlePutRequest($id);
    }

    /**
     * Create new contact group
     *
     * @ApiDoc(
     *      description="Create new contact group",
     *      resource=true
     * )
     * @AclAncestor("oro_contact_group_create")
     */
    public function postAction()
    {
        return $this->handlePostRequest();
    }

    /**
     * REST DELETE
     *
     * @param int $id
     *
     * @ApiDoc(
     *      description="Delete Contact Group",
     *      resource=true
     * )
     * @Acl(
     *      id="oro_contact_group_delete",
     *      name="Delete contact group",
     *      description="Delete contact group",
     *      parent="oro_contact_group"
     * )
     * @return Response
     */
    public function deleteAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * Get entity Manager
     *
     * @return ApiEntityManager
     */
    protected function getManager()
    {
        return $this->get('oro_contact.group.manager.api');
    }

    /**
     * @return Form
     */
    protected function getForm()
    {
        return $this->get('oro_contact.form.group.api');
    }

    /**
     * @return ApiFormHandler
     */
    protected function getFormHandler()
    {
        return $this->get('oro_contact.form.handler.group.api');
    }
}
