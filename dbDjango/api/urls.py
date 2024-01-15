
from django.conf import settings
from django.conf.urls.static import static
from django.urls import path
from .views import LoginView, CustomUserList, CustomUserDetail, PeliculaList, PeliculaDetail, ReservaList, ReservaDetail, CarritoList, CarritoDetail, CompraList, CompraDetail, ResenaListCreateView, ResenaDetailView
from rest_framework import permissions
from drf_yasg.views import get_schema_view
from drf_yasg import openapi
schema_view = get_schema_view(
    openapi.Info(
        title="Tu API",
        default_version='v1',
        description="Descripción de tu API",
        terms_of_service="https://www.tu-terminos-de-servicio.com/",
        contact=openapi.Contact(email="tu@email.com"),
        license=openapi.License(name="Tu Licencia"),
    ),
    public=True,
    permission_classes=(permissions.AllowAny,),
)

urlpatterns = [
    path('login/', LoginView.as_view(), name='login'),
     
    path('swagger/', schema_view.with_ui('swagger', cache_timeout=0), name='schema-swagger-ui'),
    path('redoc/', schema_view.with_ui('redoc', cache_timeout=0), name='schema-redoc'),

    path('usuarios/', CustomUserList.as_view(), name='customuser-list'),
    path('usuarios/<int:pk>/', CustomUserDetail.as_view(), name='customuser-detail'),

    path('peliculas/', PeliculaList.as_view(), name='pelicula-list'),
    path('peliculas/<int:pk>/', PeliculaDetail.as_view(), name='pelicula-detail'),

    path('reservas/', ReservaList.as_view(), name='reserva-list'),
    path('reservas/<int:pk>/', ReservaDetail.as_view(), name='reserva-detail'),

    path('carritos/', CarritoList.as_view(), name='carrito-list'),
    path('carritos/<int:pk>/', CarritoDetail.as_view(), name='carrito-detail'),

    path('compras/', CompraList.as_view(), name='compra-list'),
    path('compras/<int:pk>/', CompraDetail.as_view(), name='compra-detail'),

    path('resenas/', ResenaListCreateView.as_view(), name='resena-list-create'),
    path('resenas/<int:pk>/', ResenaDetailView.as_view(), name='resena-detail'),

]

if settings.DEBUG:
    urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
