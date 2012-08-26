from piston.handler import BaseHandler, AnonymousBaseHandler
from bookstore.models import *
from bookstore.forms import CommentForm, UserProfileForm
from piston.utils import rc
from django.contrib.auth.models import User

from bookstore.resource import validate
from  django.core.exceptions import ObjectDoesNotExist 


class BookHandler(BaseHandler):
    model = Book
    fields = ('id','title', 'slug', 'average', 'description', 'authors_list', 'categories_list')
    
    @classmethod
    def authors_list(self, book):
        return Author.objects.filter(id__in = book.authors)
        pass
        
    @classmethod
    def categories_list(self, book):
        return Category.objects.filter(id__in = book.categories)
        pass
    
    def read(self, request, category_slug):
        
        try:
            category = Category.objects.get(slug = category_slug)
        except ObjectDoesNotExist:
            return rc.NOT_FOUND
        
        
        return Book.objects.filter(categories = category.id)
        
        
class BookDetailsHandler(BookHandler):
    def read(self, request, book_slug):
        
        try:
            return Book.objects.get(slug = book_slug)
        except ObjectDoesNotExist:
            return rc.NOT_FOUND
        
        

class LatestHandler(BaseHandler):
    model = Book
    fields = ('id','title', 'slug', 'average', 'description', 'authors_list', 'categories_list')
    
    @classmethod
    def authors_list(self, book):
        return Author.objects.filter(id__in = book.authors)
        pass
        
    @classmethod
    def categories_list(self, book):
        return Category.objects.filter(id__in = book.categories)
        pass

    def read(self, request):
        
        return Book.objects.order_by('-id')
    

class AnonymousCommentHandler(AnonymousBaseHandler):
    model = Comment
    fields = ('title', 'content', ('user', ('id','first_name', 'last_name', 'username')), 'date', 'grade')

    def read(self, request, book_id):
        
        return self.model.objects.filter(book = book_id)

class CommentHandler(BaseHandler):
    anonymous = AnonymousCommentHandler
    allowed_methods = ('GET', 'PUT', 'DELETE', 'POST')
    model = Comment
    fields = ('title', 'content', ('user', ('id','first_name', 'last_name', 'username')), 'date', 'grade')   

    def read(self, request, book_id):
        
        self.anonymous.read(request, book_id)
    
    @validate(CommentForm)
    def create(self, request, book_id):
        data = request.data
        
        book = Book.objects.filter(id = book_id).exists()
        
        if not book:
            return rc.NOT_FOUND;
        
        em = self.model(
                        title=data['title'], 
                        content=data['content'], 
                        grade = data['grade'], 
                        book_id = book_id, 
                        user_id = request.user.id
                        )
        em.save()
        
            
        return rc.CREATED

class CategoryHandler(BaseHandler):
    allowed_methods = ('GET')
    model = Category
    fields = ('id','name', 'count', 'slug')   

    def read(self, request):
        
        return self.model.objects.order_by('name')

class RegisterHandler(BaseHandler):
    model = User
    alowed_methods = ('POST')
    fields = ('id', 'username')
    @validate(UserProfileForm)
    
    def create(self, request, *args, **kwargs):
        
        user = User.objects.create_user(request.data['username'], request.data['email'], request.data['password'])
        
        user.first_name =  request.data['first_name']
        user.last_name =  request.data['last_name']
        
        user.save()
        
            
        return rc.CREATED

class AnonymousAuthHandler(AnonymousBaseHandler):
    model = User
    def read(self, request):
        
        return {'auth': False}

class AuthHandler(BaseHandler):
    allowed_methods = ('POST', 'GET')
    model = User
    anonymous = AnonymousAuthHandler
    
    def read(self, request):
        return {'auth': True, 'user': {'user_id': request.user.id, 'user_username': request.user.username, 'user_email': request.user.email, 'user_name': request.user.first_name, 'user_lastname': request.user.last_name }}
    
        
        
        