# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('Supplier', '0001_initial'),
    ]

    operations = [
        migrations.RenameField(
            model_name='supplier',
            old_name='ContName',
            new_name='ContactName',
        ),
        migrations.RenameField(
            model_name='supplier',
            old_name='SuppName',
            new_name='Supplier',
        ),
        migrations.RenameField(
            model_name='supplier',
            old_name='ManuDes',
            new_name='SupplierDes',
        ),
    ]
