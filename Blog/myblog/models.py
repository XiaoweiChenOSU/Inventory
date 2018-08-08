from django.db import models

# Create your models here.

class Article(models.Model):

    STATUS_CHOICES = (
        ('d','Draft'),
        ('p','Published'),
    )

    title = models.CharField('Title', max_length = 70)

    body = models.TextField('Content')

    create_time = models.DateTimeField('Create Time',auto_now_add=True)

    last_modified_time = models.DateTimeField('Modify Time', auto_now=True)

    status = models.CharField('article status', max_length=1,choices = STATUS_CHOICES)