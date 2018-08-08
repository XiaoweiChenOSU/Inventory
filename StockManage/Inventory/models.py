from django.db import models
import uuid

# Create your models here.

class Cart(models.Model):
    CartCode = models.CharField(max_length = 100,unique=True)
    CartId = models.UUIDField(primary_key = True, default = uuid.uuid1, editable = False)
    date_time = models.DateTimeField(auto_now_add= True)

    def __str__(self):
        return self.CartCode

    class Meta:
        ordering = ['-date_time']     