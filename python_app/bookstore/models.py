#-*- coding: utf-8 -*-

from django.db import models
from django.contrib.auth.models import User
from django.template.defaultfilters import slugify
from bookstore.widgets import ModelListField

class Author(models.Model):
    name = models.CharField(max_length = 100)
    lastname = models.CharField(max_length = 100)
    def __str__(self):
        return self.name + " " + self.lastname
    class Meta:
        verbose_name_plural = "Autorzy"
        verbose_name = "Autor"

class Category(models.Model):
    name = models.CharField(max_length = 100)
    slug = models.SlugField(max_length=100, editable = False)
    count = models.PositiveIntegerField(editable = False, default = 0)
    def save(self):
        self.slug = slugify(self.name)
        
        super(Category, self).save()
    def __str__(self):
        return self.name
    class Meta:
        verbose_name_plural = "Kategoria"
        verbose_name = "Kategorie"

class Book(models.Model):
    title = models.CharField(max_length = 100)
    slug = models.SlugField(max_length=100, editable = False)
    categories = ModelListField(models.ForeignKey(Category))
    authors = ModelListField(models.ForeignKey(Author))
    average = models.DecimalField(max_digits=3, decimal_places=2, editable = False, default = 0.0)
    description = models.TextField()
    def save(self):
        self.slug = slugify(self.title)
        
        
        if self.id is None:
            for category in self.categories:
                c = Category.objects.get(id = category)
                c.count = 1 if not c.count else c.count + 1
                c.save()
            
        
        super(Book, self).save()
    def __str__(self):
        return self.title
    class Meta:
        verbose_name_plural = "Książka"
        verbose_name = "Książki"

SCORE_CHOICES = zip( range(1,6), range(1,6) )

class Comment(models.Model):
    title = models.CharField(max_length = 100)
    content = models.TextField()
    date = models.DateTimeField(auto_now_add = True)
    book = models.ForeignKey(Book)
    user = models.ForeignKey(User, editable=False)
    grade = models.PositiveIntegerField(choices = SCORE_CHOICES, blank = False)
    def __str__(self):
        return self.title
    
    def save(self, force_insert=False, force_update=False, using=None):
        
        comments = Comment.objects.filter(book = self.book)
        average = 0.00
        
        
        for comment in comments:
            average += comment.grade

        self.book.average = self.grade if not average else (average + float(self.grade)) / (comments.count() + 1)
        self.book.save()
        
        super(Comment, self).save()
        
    
    class Meta:
        verbose_name_plural = "Komentarze"
        verbose_name = "Komentarz"