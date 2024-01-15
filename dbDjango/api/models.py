
from django.db import models
from django.contrib.auth.models import AbstractUser,Group, Permission

class CustomUser(AbstractUser):
    cedula = models.CharField(max_length=15, unique=True)
    nombres = models.CharField(max_length=255)
    apellidos = models.CharField(max_length=255)
    email = models.EmailField(unique=True)
    celular = models.CharField(max_length=15)
    historial_compras = models.ManyToManyField('Compra', related_name='compras', blank=True)

    # Añadir related_name a groups y user_permissions para evitar conflictos
    groups = models.ManyToManyField(Group, related_name='custom_user_groups', blank=True)
    user_permissions = models.ManyToManyField(Permission, related_name='custom_user_permissions', blank=True)

    def __str__(self):
        return self.email

class Pelicula(models.Model):
    nombre = models.CharField(max_length=255)
    genero = models.CharField(max_length=100)
    año = models.IntegerField()
    elenco_principal = models.TextField()
    director = models.CharField(max_length=255)
    sinopsis = models.TextField()
    estudio = models.CharField(max_length=100)
    imagen = models.ImageField(upload_to='peliculas/', null=True, blank=True)

    def __str__(self):
        return self.nombre

class Reserva(models.Model):
    pelicula = models.ForeignKey(Pelicula, on_delete=models.CASCADE)
    fecha_reserva = models.DateTimeField(auto_now_add=True)
    usuario = models.ForeignKey(CustomUser, on_delete=models.CASCADE)

    def __str__(self):
        return f"Reserva para {self.pelicula.nombre} por {self.usuario.email} en {self.fecha_reserva}"

class Carrito(models.Model):
    usuario = models.OneToOneField(CustomUser, on_delete=models.CASCADE)
    peliculas = models.ManyToManyField(Pelicula, related_name='peliculas_en_carrito')

    def __str__(self):
        return f"Carrito de {self.usuario.email}"

class Compra(models.Model):
    pelicula = models.ForeignKey(Pelicula, on_delete=models.CASCADE)
    fecha_compra = models.DateTimeField(auto_now_add=True)
    usuario = models.ForeignKey(CustomUser, on_delete=models.CASCADE)

    def __str__(self):
        return f"Compra de {self.pelicula.nombre} por {self.usuario.email} en {self.fecha_compra}"

class Resena(models.Model):
    pelicula = models.ForeignKey(Pelicula, on_delete=models.CASCADE, related_name='resenas')
    usuario = models.ForeignKey(CustomUser, on_delete=models.CASCADE)
    calificacion = models.IntegerField(choices=[(i, i) for i in range(1, 6)])
    comentario = models.TextField()
    fecha_resena = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return f"Reseña de {self.pelicula.nombre} por {self.usuario.email} ({self.calificacion}/5) en {self.fecha_resena}"