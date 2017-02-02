<?php

namespace TheoGuerin\ApiController;

use TheoGuerin\Model\Proposal;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class ProposalController{

    public function getAllProposalAction(Request $req, Application $app)
    {
        $proposal = $app["dao.proposal"]->getAll();
        return $app["views"]->success($proposal);
    }


    public function postProposalAction(Request $req, Application $app)
    {
        $proposal = $app['hydrator']->hydrate($req->request->all(),'TheoGuerin\Model\Proposal');

        if(gettype($proposal) == 'string'){
            return $app["views"]->error($proposal);
        }

        $app['dao.proposal']->save($proposal);
        return $app["views"]->success($proposal,201);
    }

    public function deleteProposalAction(Request $req, Application $app,$id){
        $proposal = $app["dao.proposal"]->getOneById($id);

        if ($proposal === null){
            return $app["views"]->error('Proposal not found',404);
        } else {
            $app['dao.proposal']->remove($proposal);
            return $app["views"]->success($proposal);
        }
    }

}
