<?php

namespace Oro\Bundle\SalesBundle\Migrations\Schema\v1_18;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class OroSalesBundle implements Migration
{
    #[\Override]
    public function up(Schema $schema, QueryBag $queries): void
    {
        $table = $schema->getTable('oro_email_mailbox_process');
        $table->addColumn('lead_channel_id', 'integer', ['notnull' => false]);
        $table->addColumn('lead_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('lead_source_id', 'string', ['notnull' => false, 'length' => 32]);
        $table->addIndex(['lead_owner_id'], 'IDX_CE8602A3D46FE3FA');
        $table->addIndex(['lead_channel_id'], 'IDX_CE8602A35A6EBA36');
        $table->addForeignKeyConstraint(
            $schema->getTable('orocrm_channel'),
            ['lead_channel_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['lead_owner_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
    }
}
