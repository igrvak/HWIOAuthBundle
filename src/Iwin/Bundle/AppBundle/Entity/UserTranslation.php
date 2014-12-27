<?php

namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass;
use Gedmo\Translatable\Entity\Repository;


/**
 * @ORM\Table(name="user_translations", indexes={
 *      @ORM\Index(name="user_translation_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="TranslationRepository")
 */
class UserTranslation extends AbstractTranslation
{

}
