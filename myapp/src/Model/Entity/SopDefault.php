<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SopDefault Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $graphe_id
 * @property int $defaultpoint
 * @property int $dispareamax
 * @property int $binsize
 * @property int $smooth
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Graphe $graphe
 */
class SopDefault extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'graphe_id' => true,
        'defaultpoint' => true,
        'dispareamax' => true,
        'binsize' => true,
        'smooth' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'graphe' => true,
    ];
}
