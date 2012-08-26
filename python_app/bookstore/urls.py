from django.conf.urls.defaults import *
from bookstore.handlers import CommentHandler, CategoryHandler, AuthHandler,\
    RegisterHandler, BookHandler, BookDetailsHandler, LatestHandler
from piston.authentication import HttpBasicAuthentication
from piston.emitters import Emitter, JSONEmitter


from bookstore.resource import Resource 
from django.http import HttpResponse

auth = HttpBasicAuthentication(realm="My Realm")


comment_handler = Resource(CommentHandler, authentication = auth)
category_handler = Resource(CategoryHandler)
book_handler = Resource(BookHandler)
book_detail_handler = Resource(BookDetailsHandler)
latest_handler = Resource(LatestHandler)

auth_handler = Resource(AuthHandler, authentication = auth)
register_handler = Resource(RegisterHandler)

urlpatterns = patterns('',
   url(r'^auth/', auth_handler, { 'emitter_format': 'json' }),
   url(r'^register/', register_handler, { 'emitter_format': 'json' }),
   url(r'^comments/(?P<book_id>\d+)/', comment_handler, { 'emitter_format': 'json' }),
   url(r'^categories/', category_handler, { 'emitter_format': 'json' }),
   url(r'^books/(?P<category_slug>.*)/', book_handler, { 'emitter_format': 'json' }),
   url(r'^book/(?P<book_slug>.*)/', book_detail_handler, { 'emitter_format': 'json' }),
   url(r'^latest/', latest_handler, { 'emitter_format': 'json' }),
)

