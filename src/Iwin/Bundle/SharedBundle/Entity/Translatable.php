<?php
namespace Iwin\Bundle\SharedBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Knp\DoctrineBehaviors\Model\Translatable as Trans;

/**
 * Трейт для переводов
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
trait Translatable
{
    use Trans\TranslatableMethods;

    protected $newTranslations;
    protected $currentLocale;


    /**
     * @Serializer\PostDeserialize
     */
    public function ____update_translations()
    {
        $ret = [];
        /** @noinspection PhpUndefinedFieldInspection */
        foreach ($this->translations as $trans) {
            /** @var Trans\Translation $trans */
            $trans->setTranslatable($this);
            $ret[$trans->getLocale()] = $trans;
        }
        $this->translations = new ArrayCollection($ret);
    }

    /**
     * {@inheritdoc}
     */
    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }
}