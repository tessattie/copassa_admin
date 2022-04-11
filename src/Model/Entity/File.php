<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $location
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $extension
 * @property int $user_id
 * @property string|null $description
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Folder[] $folders
 */
class File extends Entity
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
        'name' => true,
        'location' => true,
        'created' => true,
        'modified' => true,
        'extension' => true,
        'user_id' => true,
        'description' => true,
        'user' => true,
        'folders' => true,
        'tenant_id' => true
    ];
}
