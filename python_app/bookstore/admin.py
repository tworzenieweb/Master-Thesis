from bookstore.models import *
from django.contrib import admin
from bookstore.forms import BookForm, CommentForm
from functools import partial 

admin.site.register(Category)
admin.site.register(Author)


class CommentAdmin(admin.ModelAdmin):
    form = CommentForm

    def save_model(self, request, obj, form, change):
        
        if request.user:
            obj.user = request.user

            
            
        obj.save()


admin.site.register(Comment, CommentAdmin)

class BookAdmin(admin.ModelAdmin):
    form = BookForm

    def __init__(self, model, admin_site):
        
        
        self.form.admin_site = admin_site
        super(BookAdmin,self).__init__(model, admin_site)

admin.site.register(Book, BookAdmin)