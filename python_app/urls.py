from django.conf.urls.defaults import *

# Uncomment the next two lines to enable the admin:
from django.contrib import admin

from django.db.models.loading import cache as model_cache
if not model_cache.loaded:
    model_cache.get_models()

admin.autodiscover()

handler500 = 'djangotoolbox.errorviews.server_error'


urlpatterns = patterns('',
    ('^_ah/warmup$', 'djangoappengine.views.warmup'),
    ('^$', 'django.views.generic.simple.direct_to_template',
     {'template': 'home.html'}),
    url(r'^admin/', include(admin.site.urls)),
    ('^login/$', 'django.contrib.auth.views.login'),
    ('^logout/$', 'django.contrib.auth.views.logout'),
    (r'^api/', include('bookstore.urls')),
)

