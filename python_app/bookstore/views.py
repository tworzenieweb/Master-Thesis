from django.contrib.auth.decorators import login_required
from django.shortcuts import render_to_response
from django.template import RequestContext
from django.http import HttpResponseRedirect
from django.core.urlresolvers import reverse
from forms import PostForm
from models import Post

from django.views.decorators.csrf import csrf_protect
from django.template import RequestContext

@login_required
@csrf_protect
def new_post(request):
    form = PostForm()
    
    c = {}
    
    if request.method == 'POST':
        form = PostForm(request.POST)
        if form.is_valid():
            form.save(request.user)
            return HttpResponseRedirect(reverse('bookstore.views.list_posts'))
    return render_to_response('new_post.html',
            locals(), context_instance=RequestContext(request)
    )

def list_posts(request):
    posts = Post.objects.all()
    return render_to_response('list_posts.html',
            locals(), context_instance=RequestContext(request)
    )