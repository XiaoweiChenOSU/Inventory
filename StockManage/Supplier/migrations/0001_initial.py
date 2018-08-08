# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import migrations, models
import uuid


class Migration(migrations.Migration):

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Supplier',
            fields=[
                ('SuppName', models.CharField(max_length=100)),
                ('SuppId', models.UUIDField(primary_key=True, default=uuid.uuid1, editable=False, serialize=False)),
                ('ContName', models.CharField(max_length=50)),
                ('Phone', models.CharField(max_length=50)),
                ('ManuDes', models.TextField(blank=True, null=True)),
                ('Street', models.CharField(max_length=150)),
                ('City', models.CharField(max_length=100)),
                ('State', models.CharField(max_length=50)),
                ('ZipCode', models.CharField(max_length=10)),
                ('Fax', models.CharField(max_length=50)),
                ('Email', models.EmailField(max_length=254)),
                ('date_time', models.DateTimeField(auto_now_add=True)),
            ],
            options={
                'ordering': ['-date_time'],
            },
        ),
    ]
