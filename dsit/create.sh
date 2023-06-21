set -e

echo "####################################"
echo "Creando Imagen Laravel Nombre sitio web Uniandes"
echo "####################################"

rm  app_laravel.tar || true

echo "####################################"
echo "Moviendo folder _resources"
echo "####################################"

mv ../resources ../_resources || true

echo "####################################"
echo "Creando tar"
echo "####################################"

cd ../ && tar --exclude='./.git' --exclude='./dsit' --exclude='/app_laravel.tar' -cvf app_laravel.tar *

echo "####################################"
echo "Otorgando permisos"
echo "####################################"
chmod 775 -R app_laravel.tar

echo "####################################"
echo "Moviendo al contexto Docker"
echo "####################################"

mv app_laravel.tar dsit/

echo "####################################"
echo "Compilando imagen"
echo "####################################"

cd dsit/ && docker build . -t sitiosweb/sw-larvel-formularios-fpm:1.0.0

exec "$@"
#docker  tag sitiosweb/sw-larvel-formularios-fpm:1.0.0  andescontainers.azurecr.io/sw-larvel-formularios-fpm:1.0.0
#docker push andescontainers.azurecr.io/sw-larvel-formularios-fpm:1.0.0
#az login
#az acr login --name andescontainers


