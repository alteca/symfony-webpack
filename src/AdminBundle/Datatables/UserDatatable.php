<?php

namespace AdminBundle\Datatables;

use Sg\DatatablesBundle\Datatable\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Style;
use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;

/**
 * Class UserDatatable
 *
 * @package AdminBundle\Datatables
 */
class UserDatatable extends AbstractDatatable
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->language->set(array(
            'cdn_language_by_locale' => true,
            'language' => 'fr'
        ));

        $this->ajax->set(array(
        ));

        $this->options->set(array(
            'classes' => Style::BOOTSTRAP_3_STYLE,
            'individual_filtering' => false,
            'order_cells_top' => false,
        ));

        $this->features->set(array(
        ));

        $this->columnBuilder
            ->add('id', Column::class, array(
                'title' => 'Id',
                ))
            ->add('firstname', Column::class, array(
                'title' => 'Firstname',
                ))
            ->add('lastname', Column::class, array(
                'title' => 'Lastname',
                ))
            ->add('email', Column::class, array(
                'title' => 'Email',
                ))
            ->add(null, ActionColumn::class, array(
                'title' => $this->translator->trans('sg.datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'user_edit',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => $this->translator->trans('sg.datatables.actions.edit'),
                        'icon' => 'glyphicon glyphicon-edit',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('sg.datatables.actions.edit'),
                            'class' => 'btn btn-primary',
                            'role' => 'button'
                        ),
                    )
                )
            ));

        $this->extensions->set(array(
            //'responsive' => true,
            'responsive' => array(
                //'details' => true,
                'details' => array(
                    'display' => array(
                        'template' => 'AdminBundle:user:_edit.js.twig',
                        //'vars' => array('id' => '2', 'test' => 'new value'),
                    ),
                    'renderer' => array(
                        'template' => 'AdminBundle:user:_renderer.js.twig',
                    ),
                ),
            ),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'AppBundle\Entity\User';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user_datatable';
    }
}
