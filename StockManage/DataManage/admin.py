from django.contrib import admin
from DataManage.models import Item
from DataManage.models import Brand
from DataManage.models import Label
from DataManage.models import Statu
from DataManage.models import Supplier
from DataManage.models import Item_Classification
# Register your models here.

admin.site.register(Item)
admin.site.register(Brand)
admin.site.register(Label)
admin.site.register(Statu)
admin.site.register(Supplier)
admin.site.register(Item_Classification)