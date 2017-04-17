<?php

namespace Brp\NotificationSenderBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * NotificationTemplateParameterRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NotificationTemplateParameterRepository extends EntityRepository
{
    public function getCodeValueTemplateParams($template)
    {
        $result = [];
        $qb = $this->createQueryBuilder('p')
            ->select('p.code', 'p.value')
            ->where('p.template = :template')
            ->setParameter('template', $template)
        ;

        $queryResults = $qb->getQuery()->getArrayResult();

        foreach ($queryResults as $qr) {
            $result[$qr['code']] = $qr['value'];
        }

        // TODO: fix this place
        $result['Body'] = $template->getBody();

        return $result;
    }
}
