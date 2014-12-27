<?php

namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;


/**
 * @ORM\Table(name="iwin_app_user_translations", indexes={
 *      @ORM\Index(name="user_translation_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class UserTranslation extends AbstractTranslation
{

}
