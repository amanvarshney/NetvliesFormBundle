<?php

/*
 * (c) Netvlies Internetdiensten
 *
 * Jeroen van den Enden <jvdenden@netvlies.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Netvlies\Bundle\NetvliesFormBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Netvlies\Bundle\NetvliesFormBundle\Entity\Form;

class FormFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Contact form
        $form = new Form();
        $form->setLabel('Contact form');
        $form->setSuccessAction('url');
        $form->addField($manager->merge($this->getReference('field_contact_salutation')));
        $form->addField($manager->merge($this->getReference('field_contact_name')));
        $form->addField($manager->merge($this->getReference('field_contact_email')));
        $form->addField($manager->merge($this->getReference('field_contact_message')));
        $manager->persist($form);

        $this->addReference('form_contact', $form);

        // Application form
        $form = new Form();
        $form->setLabel('Application form');
        $form->setSuccessAction('url');
        $form->addField($manager->merge($this->getReference('field_application_name')));
        $form->addField($manager->merge($this->getReference('field_application_function')));
        $form->addField($manager->merge($this->getReference('field_application_motivation')));
        $manager->persist($form);

        $this->addReference('form_application', $form);

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 3;
    }
}
