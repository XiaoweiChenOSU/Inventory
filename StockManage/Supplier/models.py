import uuid
from django.db import models


# Create your models here.
class Supplier(models.Model):
    Supplier = models.CharField(max_length = 100)
    SuppId = models.UUIDField(primary_key = True, default = uuid.uuid1, editable = False)
    ContactName = models.CharField(max_length = 50)
    Phone = models.CharField(max_length = 50)
    Street = models.CharField(max_length = 150)
    City = models.CharField(max_length = 100)
    State = models.CharField(max_length = 50)
    ZipCode = models.CharField(max_length = 10)
    Fax = models.CharField(max_length = 50)
    Email = models.EmailField(max_length = 254)
    SupplierDes = models.TextField(blank= True, null= True)
    date_time = models.DateTimeField(auto_now_add= True)

    def __str__(self):
        return self.SuppName

    class Meta:
        ordering = ['-date_time']        