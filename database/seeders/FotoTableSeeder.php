<?php

namespace Database\Seeders;

use App\Models\Foto;
use App\Models\AreaPicture;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class FotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $foto=new Foto();
        $foto->img_url='Frente.jpg';
        $foto->name='Frente a la calle';
        $foto->description='Así luce el frente de Hostal Mirakuru Gran Familia desde la calle principal de la ciudad';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=6;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Frente_New.jpg';
        $foto->name='Nuevo frente a la calle';
        $foto->description='Así luce actualmente el frente de Hostal Mirakuru Gran Familia desde la calle principal de la ciudad';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=6;
        $foto->ppal=1;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Habitacion_Azul-1.jpg';
        $foto->name='Habitacion triple';
        $foto->description='Cuenta con 2 camas, cama camera, cama personal, baño privado, con capacidad máxima de 3 personas';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=3;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Habitacion_Azul-2.jpg';
        $foto->name='Habitacion triple Azul';
        $foto->description='Cuenta con 2 camas, cama camera, cama personal, baño privado, con capacidad máxima de 3 personas';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=3;
        $foto->ppal=1;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Habitacion_Verde-1.jpg';
        $foto->name='Habitacion triple Verde';
        $foto->description='Cuenta con 2 camas, cama camera, cama personal, baño privado, con capacidad máxima de 3 personas, además de una terraza';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=3;
        $foto->ppal=1;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Baño_Habitacion_Azul.jpg';
        $foto->name='Baño de Habitacion Azul';
        $foto->description='Cuenta con agua caliente y fría, bañera, lavamanos, taza sanitaria, espejo';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=7;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Baño_Habitacion_Verde.jpg';
        $foto->name='Baño de Habitacion Verde';
        $foto->description='Cuenta con agua caliente y fría, bañera, lavamanos, taza sanitaria, espejo';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=7;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Propietarios.jpg';
        $foto->name='Anfitriones de la casa';
        $foto->description='Jóvenes que atienden el hostal, atentos, amables, dispuestos';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=7;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Sala.jpg';
        $foto->name='Sala de la casa';
        $foto->description='Lugar amueblado que los huéspedes pueden disfrutar y compartir';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=1;
        $foto->ppal=1;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Sala_New_Decoration.jpg';
        $foto->name='Decoración nueva de la sala';
        $foto->description='Alguna de las decoraciones de la sala';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=1;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Sala_Nueva_Decoracion.jpg';
        $foto->name='Decoración nueva de la sala- otra vista';
        $foto->description='Alguna de las decoraciones de la sala';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=1;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Amanecer_Terraza.jpg';
        $foto->name='Amanecer desde terraza';
        $foto->description='Vista de un amanecer desde la terraza';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=5;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Terraza_Comedor.jpg';
        $foto->name='Zona de cenas y desayunos';
        $foto->description='Vista del espacio donde podrá disfrutar de cenas y desayunos al aire libre';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=5;
        $foto->ppal=1;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Terraza_con_Vista.jpg';
        $foto->name='Vita a la ciudad desde la terraza';
        $foto->description='Vista de la ciudad y montañas';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=5;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Terraza_con_Vista_Montañas_Ciudad.jpg';
        $foto->name='Vita soleada a la ciudad desde la terraza';
        $foto->description='Vista soleada de la ciudad y montañas';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=5;
        $foto->save();

        $foto=new Foto();
        $foto->img_url='Terraza_Vista.jpg';
        $foto->name='Vista de la terraza';
        $foto->description='Vista ampliada de la terraza';
        $foto->slug=Str::slug($foto->name, '-');
        $foto->hostal_id=1;
        $foto->area_id=5;
        $foto->ppal=1;
        $foto->save();
    }
}
