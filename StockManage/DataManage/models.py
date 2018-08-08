from django.db import models
import uuid


# Create your models here.

class Item(models.Model):
    ItemName = models.CharField(max_length = 100)
    ItemId = models.UUIDField(primary_key = True, default = uuid.uuid1, editable = False)
    UPC = models.CharField(max_length = 50)
    NDC = models.CharField(max_length = 50)
    ItemDes = models.TextField(blank= True, null= True)
    date_time = models.DateTimeField(auto_now_add= True)

    def __str__(self):
        return self.ItemName

    class Meta:
        ordering = ['-date_time']    

class Sale_Label(models.Model):
    LabelName = models.CharField(max_length = 100)
    LabelId = models.UUIDField(primary_key = True, default = uuid.uuid1, editable = False)
    date_time = models.DateTimeField(auto_now_add= True)

    def __str__(self):
        return self.LabelName

    class Meta:
        ordering = ['-date_time']     

class Brand(models.Model):
    BrandName = models.CharField(max_length = 100)
    BrandId = models.UUIDField(primary_key = True, default = uuid.uuid1, editable = False)
    date_time = models.DateTimeField(auto_now_add= True)

    def __str__(self):
        return self.BrandName

    class Meta:
        ordering = ['-date_time']          

class Label(models.Model):
    LabelName = models.CharField(max_length = 100)
    LabelId =  models.UUIDField(primary_key = True, default = uuid.uuid1, editable = False)
    date_time = models.DateTimeField(auto_now_add= True)

    def __str__(self):
        return self.LabelName

    class Meta:
        ordering = ['-date_time']    

class Statu(models.Model):
    StatusName = models.CharField(max_length = 100)
    StatusId =  models.UUIDField(primary_key = True, default = uuid.uuid1, editable = False)
    date_time = models.DateTimeField(auto_now_add= True)

    def __str__(self):
        return self.StatusName

    class Meta:
        ordering = ['-date_time']   

class Supplier(models.Model):
    Supplier = models.CharField(max_length = 100)
    CompanyName = models.CharField(max_length = 100,blank= True, null= True)
    SuppId = models.UUIDField(primary_key = True, default = uuid.uuid1, editable = False)
    ContactName = models.CharField(max_length = 50)
    Email = models.EmailField(max_length = 200)
    Phone = models.CharField(max_length = 50,blank= True, null= True)
    DefaultLeadTime = models.IntegerField(max_length = 10,blank= True, null= True)
    Enable = models.BooleanField(default = True)
    Fax = models.CharField(max_length = 50,blank= True, null= True)
    Street = models.CharField(max_length = 150,blank= True, null= True)
    City = models.CharField(max_length = 100,blank= True, null= True)
    State = models.CharField(max_length = 50,blank= True, null= True)
    ZipCode = models.CharField(max_length = 10,blank= True, null= True)
    AccountNum = models.IntegerField(max_length = 10,blank= True, null= True)
    Url = models.TextField(max_length = 200,blank= True, null= True)
    SupplierDes = models.TextField(blank= True, null= True)
    Other = models.TextField(blank=True, null=True)
    date_time = models.DateTimeField(auto_now_add= True)

    def __str__(self):
        return self.SuppName

    class Meta:
        ordering = ['-date_time'] 

'''
class Item_Classification(models.Model):
    ClassificationName = models.CharField(max_length = 100)
    ClassificationId = models.UUIDField(primary_key = True, default = uuid.uuid1, editable = False)
    Enable = models.BooleanField(default = True)
    date_time = models.DateTimeField(auto_now_add= True)

    class Attribute():
        Order = models.AutoField()
        Name = models.CharField(max_length = 100)
        Enable = models.BooleanField(default = True)
        Required = models.BooleanField(default = True)
        #while True:
        Vaule = models.CharField(max_length = 100)
        AttributeId = models.UUIDField(primary_key = True, default = uuid.uuid1, editable = False)
        date_time = models.DateTimeField(auto_now_add= True)

        def __str__(self):
            return self.Name
        
        class Meta:
            ordering = ['-date_time'] 

    def __str__(self):
        return self.ClassificationName

    class Meta:
        ordering = ['-date_time'] 
'''   


class Warehouse(models.Model):
    WareId = models.UUIDField(primary_key = True, default = uuid.uuid1, editable = False)
    Warehouse = models.CharField(max_length = 100)
    WareCode = models.CharField(max_length = 100)
    External = models.BooleanField()
    ContactName = models.CharField(max_length = 50)
    Phone = models.CharField(max_length = 50)
    Street = models.CharField(max_length = 150)
    City = models.CharField(max_length = 100)
    State = models.CharField(max_length = 50)
    ZipCode = models.CharField(max_length = 10)
    Fax = models.CharField(max_length = 50)
    Email = models.EmailField(max_length = 254)
    WarehouseDes = models.TextField(blank= True, null= True)
    date_time = models.DateTimeField(auto_now_add= True)

    def __str__(self):
        return self.SuppName

    class Meta:
        ordering = ['-date_time']        