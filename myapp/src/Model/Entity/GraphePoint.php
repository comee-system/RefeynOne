<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GraphePoint Entity
 *
 * @property int $id
 * @property int|null $graphe_id
 * @property int|null $graphe_data_id
 * @property int $user_id
 * @property int $pointdata
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Graph $graph
 * @property \App\Model\Entity\GraphData $graph_data
 */
class GraphePoint extends Entity
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
        'graphe_id' => true,
        'graphe_data_id' => true,
        'user_id' => true,
        'pointdata' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'graph' => true,
        'graph_data' => true,
    ];
}
