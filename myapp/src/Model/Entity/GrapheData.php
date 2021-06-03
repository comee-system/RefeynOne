<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GrapheData Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $graphe_id
 * @property string $label
 * @property string $filename
 * @property int $counts
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Graphe $graphe
 * @property \App\Model\Entity\GrapheDataPoint[] $graphe_data_point
 */
class GrapheData extends Entity
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
        'label' => true,
        'filename' => true,
        'disp' => true,
        'counts' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'graphe' => true,
        'graphe_data_point' => true,
    ];
}
