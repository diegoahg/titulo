<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriasTableSeeder::class);
        $this->call(CentroCostoTableSeeder::class);
        $this->call(SectorTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CuentaContableTableSeeder::class);
        $this->call(TipoBienTableSeeder::class);
    }
}


class CategoriasTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categoria')->delete();

        DB::table('categoria')->insert([
            array('id' => 1, 'categoria' => "Muebles",'codigo' => "W",'descripcion' => "Articulos tangibles que tienen que ver con muebles como sillas y mesas"),
            array('id' => 2, 'categoria' => "Computación",'codigo' => "X",'descripcion' => "Articulos tangibles que tienen que ver con computación como notebooks y desktop"),
            array('id' => 3, 'categoria' => "Vehiculos",'codigo' => "Y",'descripcion' => "Articulos tangibles que tienen que ver con vehiculos como autos y camionetas"),
            array('id' => 4, 'categoria' => "Herramientas",'codigo' => "Z",'descripcion' => "Articulos tangibles que tienen que ver con herramientas"),
        ]);
    }

}

class CentroCostoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('centro_costo')->delete();

        DB::table('centro_costo')->insert([
            array('id' => 1, 'codigo' =>"00.00.00", 'nombre' =>"BIENES POR DISTRIBUIR", 'direccion' =>"DIECIOCHO Nº 178"),
            array('id' => 2, 'codigo' =>"01.01.01", 'nombre' =>"RECTORIA", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 3, 'codigo' =>"01.01.02", 'nombre' =>"RELACIONES NACIONALES  E INTERNAC", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 4, 'codigo' =>"01.01.03", 'nombre' =>"DIRECC GRAL DE PLANIFICACION", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 5, 'codigo' =>"01.01.04", 'nombre' =>"PROGR TEC EDUC Y DISEÑO DITEC", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 6, 'codigo' =>"01.01.05", 'nombre' =>"PLAN ESPECIAL VESPERTINOS 161", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 7, 'codigo' =>"01.01.06", 'nombre' =>"PROGR DE POLITICAS PUBLICAS", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 8, 'codigo' =>"01.02.01", 'nombre' =>"OFICINA RECTORIA MACUL", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 9, 'codigo' =>"01.02.03", 'nombre' =>"ASOCIACION DE ACADEMICOS", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 10, 'codigo' =>"01.03.01", 'nombre' =>"SISEI", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 11, 'codigo' =>"01.03.02", 'nombre' =>"LAB. MULTIUSUARIOS 1550 ( SISEI)", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 12, 'codigo' =>"01.03.03", 'nombre' =>"LAB. MULTIUSUARIOS 1242 ( SISEI)", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 13, 'codigo' =>"01.03.04", 'nombre' =>"LAB. MULTIUSUARIOS 644 ( SISEI)", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 14, 'codigo' =>"01.04.01", 'nombre' =>"PROGR COM Y CULTURA (RECTORIA)", 'direccion' =>"DIECIOCHO Nº 178"),
            array('id' => 15, 'codigo' =>"01.04.02", 'nombre' =>"AUDITORIUM PROG CULTURA", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 16, 'codigo' =>"02.01.01", 'nombre' =>"DIR RELACIONES ESTUDIANTILES", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 17, 'codigo' =>"02.01.02", 'nombre' =>"DIR RELAC ESTUD (FEUTEM 1550)", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 18, 'codigo' =>"02.01.03", 'nombre' =>"CENTROS DE ALUMNOS MACUL", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 19, 'codigo' =>"02.02.01", 'nombre' =>"EXTENSION Y DESARROLLO CULTURAL", 'direccion' =>"SAN IGNACIO Nº 409"),
            array('id' => 20, 'codigo' =>"02.02.02", 'nombre' =>"EXTENSION Y DESARROLLO CULTURAL", 'direccion' =>"SAN IGNACIO Nº 409"),
            array('id' => 21, 'codigo' =>"02.03.01", 'nombre' =>"CENTRAL DE APUNTES PUBLICACIONES", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 22, 'codigo' =>"02.04.01", 'nombre' =>"DEPARTAMENTO DE CAPACITACION", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 23, 'codigo' =>"02.04.02", 'nombre' =>"OF. POST TITULO/CAPACITACION", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 24, 'codigo' =>"02.05.01", 'nombre' =>"EDITORIAL UTEM", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 722"),
            array('id' => 25, 'codigo' =>"02.10.01", 'nombre' =>"BIENESTAR ESTUDIANTIL 1550", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 26, 'codigo' =>"02.10.02", 'nombre' =>"BIENESTAR ESTUDIANTIL 1264/80", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1280"),
            array('id' => 27, 'codigo' =>"02.10.03", 'nombre' =>"BIENESTAR ESTUDIANTIL 644", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 28, 'codigo' =>"02.10.04", 'nombre' =>"BIENESTAR ESTUDIANTIL 390", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 29, 'codigo' =>"02.11.01", 'nombre' =>"DEPORTES Y RECREACION", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1264"),
            array('id' => 30, 'codigo' =>"02.12.01", 'nombre' =>"SERVICIO DE SALUD ESTUDIANTIL", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1264"),
            array('id' => 31, 'codigo' =>"03.01.01", 'nombre' =>"CONTRALORIA INTERNA", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 32, 'codigo' =>"04.01.01", 'nombre' =>"SECRETARIA GENERAL", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 33, 'codigo' =>"04.01.02", 'nombre' =>"AUDITORIUM SECRETARIA GENERAL", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 34, 'codigo' =>"04.02.01", 'nombre' =>"DIRECCION JURIDICA", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 35, 'codigo' =>"04.03.01", 'nombre' =>"TITULOS Y ARCHIVOS", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 36, 'codigo' =>"04.04.01", 'nombre' =>"RELACIONES PUBLICAS", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 37, 'codigo' =>"04.05.01", 'nombre' =>"OFICINA DE PARTES 161", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 38, 'codigo' =>"04.05.02", 'nombre' =>"OFICINA DE PARTES 1242", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 39, 'codigo' =>"04.05.03", 'nombre' =>"OFICINA DE PARTES 644", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 40, 'codigo' =>"04.06.01", 'nombre' =>"INFORMACION Y DIFUSION", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 41, 'codigo' =>"05.01.01", 'nombre' =>"VICERRECTORIA ACADEMICA", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 42, 'codigo' =>"05.01.02", 'nombre' =>"DIRECCION SEDES REGIONALES", 'direccion' =>"DIECIOCHO Nº 178"),
            array('id' => 43, 'codigo' =>"05.01.04", 'nombre' =>"V R ACADEMICA UNIDAD DE ESTUDIOS", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 44, 'codigo' =>"05.01.05", 'nombre' =>"UNIDAD DE CONVENIOS Y EXAMINACION", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 45, 'codigo' =>"05.02.01", 'nombre' =>"DIRECCION DE DOCENCIA 223", 'direccion' =>"ADRIANA UNDURRAGA Nº 223"),
            array('id' => 46, 'codigo' =>"05.02.02", 'nombre' =>"SECRETARIA DE ESTUDIOS Nº 390", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 47, 'codigo' =>"05.02.03", 'nombre' =>"SECRETARIA DE ESTUDIOS Nº 1242", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 48, 'codigo' =>"05.02.04", 'nombre' =>"SECRETARIA DE ESTUDIOS Nº 644", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 49, 'codigo' =>"05.02.05", 'nombre' =>"PLANES Y PROGRAMAS", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 50, 'codigo' =>"05.03.01", 'nombre' =>"DIR INVEST Y PERFECC ACADEMICO", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 51, 'codigo' =>"05.03.02", 'nombre' =>"DIR INVEST Y PERFECC ACADEMICO", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 52, 'codigo' =>"05.04.01", 'nombre' =>"BIBLIOTECA 390", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 53, 'codigo' =>"05.04.02", 'nombre' =>"BIBLIOTECA 1242", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 54, 'codigo' =>"05.04.03", 'nombre' =>"BIBLIOTECA 1550", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 55, 'codigo' =>"05.04.04", 'nombre' =>"BIBLIOTECA 644", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 56, 'codigo' =>"05.04.05", 'nombre' =>"BIBLIOTECA SAN FERNANDO", 'direccion' =>"VALDIVIA Nº 822. SAN FERNANDO"),
            array('id' => 57, 'codigo' =>"07.01.01", 'nombre' =>"VRTT Y EXT, CEDETEMA, CEDETAI", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 58, 'codigo' =>"08.01.01", 'nombre' =>"VICERRECTORIA DE FINANZAS", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 59, 'codigo' =>"08.01.02", 'nombre' =>"V R ADMINISTRACION Y FINANZAS 18/390", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 60, 'codigo' =>"08.02.01", 'nombre' =>"DIR FINANZAS / CONTABILIDAD", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 61, 'codigo' =>"08.03.01", 'nombre' =>"ARANCELES / F CRED UNIVERSITARIO", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 62, 'codigo' =>"08.04.01", 'nombre' =>"ASESORIA TECNICA", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 63, 'codigo' =>"09.01.01", 'nombre' =>"DIRECCION DE ADMINISTRACION", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 64, 'codigo' =>"09.01.02", 'nombre' =>"OFICINA AFUTEM 178", 'direccion' =>"DIECIOCHO Nº 178"),
            array('id' => 65, 'codigo' =>"09.01.03", 'nombre' =>"JEFE SEDE AREA CENTRAL", 'direccion' =>"DIECIOCHO Nº 178"),
            array('id' => 66, 'codigo' =>"09.01.06", 'nombre' =>"UNIDAD DE ESTUDIO-D ADMINISTRAC", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 67, 'codigo' =>"09.02.01", 'nombre' =>"UNIDAD DE RECURSOS HUMANOS", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 68, 'codigo' =>"09.03.01", 'nombre' =>"BIENESTAR DEL PERSONAL", 'direccion' =>"DIECIOCHO Nº 178"),
            array('id' => 69, 'codigo' =>"09.03.02", 'nombre' =>"BIENESTAR DEL PERSONAL 1242", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 70, 'codigo' =>"09.04.01", 'nombre' =>"ADQUISICIONES", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 71, 'codigo' =>"09.04.02", 'nombre' =>"DEPTO DE ABASTECIMIENTO", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 72, 'codigo' =>"09.05.01", 'nombre' =>"UNIDAD DE INVENTARIO", 'direccion' =>"DIECIOCHO Nº 178"),
            array('id' => 73, 'codigo' =>"09.05.02", 'nombre' =>"BODEGA DE MATERIALES 1550", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 74, 'codigo' =>"09.05.03", 'nombre' =>"BODEGA DE MATERIALES 1242", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 75, 'codigo' =>"09.05.04", 'nombre' =>"BODEGA DE INVENTARIO MACUL", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 76, 'codigo' =>"09.05.05", 'nombre' =>"BODEGA DE INVENTARIO 160", 'direccion' =>"DIECIOCHO Nº 160 VIDAURRE Nº 1550"),
            array('id' => 77, 'codigo' =>"09.05.06", 'nombre' =>"BODEGA DE INVENTARIO 18/390", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 78, 'codigo' =>"09.06.01", 'nombre' =>"OBRAS Y MANTENCION 161", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 79, 'codigo' =>"09.11.01", 'nombre' =>"SERVICIOS GENERALES 178", 'direccion' =>"DIECIOCHO Nº 178"),
            array('id' => 80, 'codigo' =>"09.11.02", 'nombre' =>"SERVICIOS GENERALES 1242", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 81, 'codigo' =>"09.11.03", 'nombre' =>"SERVICIOS GENERALES 161", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 82, 'codigo' =>"09.11.04", 'nombre' =>"SERVICIOS GENERALES 1550", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 83, 'codigo' =>"09.11.09", 'nombre' =>"CASINO MACUL 1242", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 84, 'codigo' =>"09.11.10", 'nombre' =>"SERVICIOS GENERALES 644", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 85, 'codigo' =>"09.11.11", 'nombre' =>"CASINO 644", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 86, 'codigo' =>"09.11.12", 'nombre' =>"SERVICIOS GENERALES ", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 722"),
            array('id' => 87, 'codigo' =>"09.11.13", 'nombre' =>"S GENERALES DIECIO/S IGNACIO ", 'direccion' =>"DIECIOCHO Nº 390 / SAN IGNACIO Nº 405"),
            array('id' => 88, 'codigo' =>"13.04.01", 'nombre' =>"LABORATORIO DE DIBUJO", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 89, 'codigo' =>"13.10.01", 'nombre' =>"LAB BIOLOGIA Y MICROBIOLOGIA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 90, 'codigo' =>"13.11.01", 'nombre' =>"INGENIERIA CIVIL INDUSTRIAL 1242", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 91, 'codigo' =>"13.12.01", 'nombre' =>"LABORATORIO DE AGUAS", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 92, 'codigo' =>"24.01.01", 'nombre' =>"ESCUELA DE ADULTOS", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 93, 'codigo' =>"26.01.01", 'nombre' =>"SEDE SAN FERNANDO", 'direccion' =>"VALDIVIA Nº 822. SAN FERNANDO"),
            array('id' => 94, 'codigo' =>"43.00.00", 'nombre' =>"FAC CS NAT MAT MEDIO AMBIENTE", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 95, 'codigo' =>"43.01.01", 'nombre' =>"DEPARTAMENTO DE QUIMICA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 96, 'codigo' =>"43.01.02", 'nombre' =>"DEPARTAMENTO DE BIOTECNOLOGIA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 97, 'codigo' =>"43.01.03", 'nombre' =>"DEPARTAMENTO DE FISICA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 98, 'codigo' =>"43.01.04", 'nombre' =>"DEPARTAMENTO DE MATEMATICA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 99, 'codigo' =>"43.01.05", 'nombre' =>"DEPARTAMENTO DE MATEMATICA", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 100, 'codigo' =>"43.02.01", 'nombre' =>"ESCUELA DE QUIMICA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 101, 'codigo' =>"43.03.01", 'nombre' =>"ESCUELA INDUSTRIA ALIMENTARIA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 102, 'codigo' =>"43.04.02", 'nombre' =>"ESCUELA INDUSTRIA DE LA MADERA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 103, 'codigo' =>"54.00.00", 'nombre' =>"FACULTAD DE INGENIERIA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 104, 'codigo' =>"54.01.01", 'nombre' =>"DEPARTAMENTO DE MECANICA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 105, 'codigo' =>"54.01.02", 'nombre' =>"DEPARTAMENTO DE ELECTRICIDAD", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 106, 'codigo' =>"54.01.03", 'nombre' =>"DEPARTAMENTO DE INDUSTRIA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 107, 'codigo' =>"54.01.04", 'nombre' =>"DEPARTAMENTO DE INFORMATICA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 108, 'codigo' =>"54.01.06", 'nombre' =>"DEPARTAMENTO DE TRANSPORTE", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1242"),
            array('id' => 109, 'codigo' =>"54.02.01", 'nombre' =>"ESCUELA DE MECANICA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1243"),
            array('id' => 110, 'codigo' =>"54.02.02", 'nombre' =>"LABORATORIO DE MECANICA (BLANCO)", 'direccion' =>"BLANCO ENCALADA Nº 2743"),
            array('id' => 111, 'codigo' =>"54.03.01", 'nombre' =>"ESCUELA DE ELECTRONICA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1245"),
            array('id' => 112, 'codigo' =>"54.05.01", 'nombre' =>"ESCUELA DE INFORMATICA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1246"),
            array('id' => 113, 'codigo' =>"54.06.01", 'nombre' =>"ESCUELA DE GEOMENSURA", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1247"),
            array('id' => 114, 'codigo' =>"54.07.01", 'nombre' =>"ESCUELA DE TRANSPORTE Y TRANSITO", 'direccion' =>"JOSE PEDRO ALESSANDRI Nº 1248"),
            array('id' => 115, 'codigo' =>"65.00.00", 'nombre' =>"FACULTAD DE HUMANIDADES Y TEC", 'direccion' =>"DIECIOCHO Nº 414"),
            array('id' => 116, 'codigo' =>"65.01.01", 'nombre' =>"DEPARTAMENTO DE CARTOGRAFIA", 'direccion' =>"SAN IGNACIO Nº 171"),
            array('id' => 117, 'codigo' =>"65.01.02", 'nombre' =>"DEPARTAMENTO DE DISEÑO", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 118, 'codigo' =>"65.01.03", 'nombre' =>"DEPARTAMENTO DE TRABAJO SOCIAL", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 119, 'codigo' =>"65.01.04", 'nombre' =>"DEPARTAMENTO DE HUMANIDADES", 'direccion' =>"ALONSO OVALLE Nº 1618"),
            array('id' => 120, 'codigo' =>"65.01.05", 'nombre' =>"DEPARTAMENTO DE HUMANIDADES", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 121, 'codigo' =>"65.02.01", 'nombre' =>"ESCUELA DE CARTOGRAFIA", 'direccion' =>"SAN IGNACIO Nº 171"),
            array('id' => 122, 'codigo' =>"65.02.02", 'nombre' =>"DEPTO CARTOGRAFIA  TACTIL", 'direccion' =>"DIECIOCHO Nº 414"),
            array('id' => 123, 'codigo' =>"65.02.04", 'nombre' =>"CARRERA DE CRIMINALISTICA", 'direccion' =>"DIECIOCHO Nº 161"),
            array('id' => 124, 'codigo' =>"65.02.05", 'nombre' =>"CARRERA DE CRIMINALISTICA", 'direccion' =>"ALMIRANTE LATORRE Nº 425"),
            array('id' => 125, 'codigo' =>"65.03.01", 'nombre' =>"ESCUELA DE DISEÑO", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 126, 'codigo' =>"65.03.02", 'nombre' =>"LABORATORIO DE PROTOTIPOS", 'direccion' =>"VIDAURRE Nº 1550 / 18 - 160"),
            array('id' => 127, 'codigo' =>"65.04.01", 'nombre' =>"ESCUELA DE TRABAJO SOCIAL", 'direccion' =>"VIDAURRE Nº 1550 "),
            array('id' => 128, 'codigo' =>"76.00.00", 'nombre' =>"FACULTAD C CIVIL Y ORD TERRITORIAL", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 129, 'codigo' =>"76.01.01", 'nombre' =>"DEPTO CS DE LA CONSTRUUCION", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 130, 'codigo' =>"76.01.02", 'nombre' =>"DEPTO PLANIF Y ORDENAMIENTO", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 131, 'codigo' =>"76.01.03", 'nombre' =>"DEPTO PREV RIESGOS Y MED AMBIENTE", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 132, 'codigo' =>"76.01.04", 'nombre' =>"LABORAT GAS DEPTO CONSTRUCC ", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 133, 'codigo' =>"76.02.01", 'nombre' =>"ESCUELA DE CONSTRUCCION CIVIL", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 134, 'codigo' =>"76.02.02", 'nombre' =>"LABORATORIO DE HORMIGONES", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 135, 'codigo' =>"76.03.01", 'nombre' =>"ESCUELA DE ARQUITECTURA", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 136, 'codigo' =>"76.04.01", 'nombre' =>"ESCUELA DE PREVENCION DE RIESGOS", 'direccion' =>"DIECIOCHO Nº 390"),
            array('id' => 137, 'codigo' =>"87.00.00", 'nombre' =>"FACULTAD ADMINISTRACION Y ECON", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 722"),
            array('id' => 138, 'codigo' =>"87.01.01", 'nombre' =>"DEPTO GESTION ORGANIZACIONAL", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 722"),
            array('id' => 139, 'codigo' =>"87.01.02", 'nombre' =>"DEPTO ECON RECUR NAT Y COM INTER", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 722"),
            array('id' => 140, 'codigo' =>"87.01.03", 'nombre' =>"DEPTO DE CONTAB Y GESTION FINANC", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 722"),
            array('id' => 141, 'codigo' =>"87.01.04", 'nombre' =>"DEPTO GESTION DE LA INFORMACION", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 722"),
            array('id' => 142, 'codigo' =>"87.01.05", 'nombre' =>"DEPTO ESTADISTICA Y ECONOMET", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 722"),
            array('id' => 143, 'codigo' =>"87.02.01", 'nombre' =>"ESC ING ADMINIST AGROINDUST", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 144, 'codigo' =>"87.02.02", 'nombre' =>"ESCUELA ADMINISTRACION 1550", 'direccion' =>"VIDAURRE Nº 1550"),
            array('id' => 145, 'codigo' =>"87.03.01", 'nombre' =>"ESC CONTADOR AUDITOR", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 146, 'codigo' =>"87.04.01", 'nombre' =>"ESC COMERCIO INTERNACIONAL", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 147, 'codigo' =>"87.05.01", 'nombre' =>"ESC BIBLIOTECOLOGIA", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 722"),
            array('id' => 148, 'codigo' =>"87.06.01", 'nombre' =>"ESC INGENIERIA COMERCIAL", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 149, 'codigo' =>"87.06.03", 'nombre' =>"INGENIERIA EN TURISMO", 'direccion' =>"DR. HERNAN ALESSANDRI Nº 644"),
            array('id' => 150, 'codigo' =>"99.99.99", 'nombre' =>"BIENES DADOS DE BAJA", 'direccion' =>""),
            array('id' => 151, 'codigo' =>"54.04.01", 'nombre' =>"ESCUELA CIVIL INDUSTRIAL", 'direccion' =>"AVDA. J. P. ALESSANDRI N| 1242"),

        ]);
    }

}

class SectorTableSeeder extends Seeder {

    public function run()
    {
        DB::table('sector')->delete();

        DB::table('sector')->insert([
            array('id' => 1, 'nombre' => "Laboratorio", "id_centro_costo" =>107),
        ]);
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            array('id' => 1, 'name' => "Admin", "apellido_paterno" =>"Admin", "apellido_materno" =>"Admin", "email" =>"admin@admin.cl",  "password" =>'$2y$10$zLYadCJrD.DJcfkZSSc.yuAabR5Vx.mWrBifyJ7xCpog.cJRHxfCO',  "fono" =>"987654321",  "movil" =>"987654321",  "departamento" =>"Adminstracion",  "cargo" =>"Admin"),
        ]);
    }

}

class TipoBienTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tipo_bien')->delete();

        DB::table('tipo_bien')->insert([
            array('id' => 1, 'codigo' =>"01.01.01", 'descripcion' =>"HORNOS"),
            array('id' => 2, 'codigo' =>"01.02.01", 'descripcion' =>"EQUIPO DE IMPRENTA"),
            array('id' => 3, 'codigo' =>"01.03.01", 'descripcion' =>"MOTORES"),
            array('id' => 4, 'codigo' =>"01.04.01", 'descripcion' =>"GENERADORES"),
            array('id' => 5, 'codigo' =>"01.05.01", 'descripcion' =>"EQUIPO DE PINTURA"),
            array('id' => 6, 'codigo' =>"01.06.01", 'descripcion' =>"EQUIPO DE SOLDAR"),
            array('id' => 7, 'codigo' =>"01.07.01", 'descripcion' =>"BOMBAS"),
            array('id' => 8, 'codigo' =>"01.08.01", 'descripcion' =>"GUILLOTINAS"),
            array('id' => 9, 'codigo' =>"01.09.01", 'descripcion' =>"TRANSFORMADORES"),
            array('id' => 10, 'codigo' =>"01.10.01", 'descripcion' =>"COMPRESORAS"),
            array('id' => 11, 'codigo' =>"01.11.01", 'descripcion' =>"CARGADORES DE BATERIA"),
            array('id' => 12, 'codigo' =>"01.12.01", 'descripcion' =>"DESTILADORES Y ALAMBIQUES"),
            array('id' => 13, 'codigo' =>"01.13.01", 'descripcion' =>"INSTRUMENTOS DE MEDICION"),
            array('id' => 14, 'codigo' =>"01.14.01", 'descripcion' =>"INSTRUMENTOS DE OBSERVACION"),
            array('id' => 15, 'codigo' =>"01.15.01", 'descripcion' =>"MAQUINAS DE ESCRIBIR MANUAL"),
            array('id' => 16, 'codigo' =>"01.15.02", 'descripcion' =>"MAQUINAS DE ESCRIBIR ELECTRICAS"),
            array('id' => 17, 'codigo' =>"01.15.03", 'descripcion' =>"MAQUINAS DE ESCRIBIR ELECTRONICAS"),
            array('id' => 18, 'codigo' =>"01.16.01", 'descripcion' =>"MAQUINAS DE CALCULAR"),
            array('id' => 19, 'codigo' =>"01.17.01", 'descripcion' =>"MAQUINAS"),
            array('id' => 20, 'codigo' =>"01.18.01", 'descripcion' =>"ROMANAS Y BALANZAS"),
            array('id' => 21, 'codigo' =>"01.19.01", 'descripcion' =>"ELEMENTOS ORTOPEDICOS"),
            array('id' => 22, 'codigo' =>"01.20.01", 'descripcion' =>"EQUIPO DENTAL"),
            array('id' => 23, 'codigo' =>"01.21.01", 'descripcion' =>"EQUIPO MEDICO"),
            array('id' => 24, 'codigo' =>"01.22.01", 'descripcion' =>"EQUIPO DE FOTOGRAFIA Y FILMACION"),
            array('id' => 25, 'codigo' =>"01.23.01", 'descripcion' =>"ELEMENTOS Y EQUIPOS DE TELEVISION"),
            array('id' => 26, 'codigo' =>"01.24.01", 'descripcion' =>"ELEMENTOS Y EQUIPOS ELECTRONICOS"),
            array('id' => 27, 'codigo' =>"01.25.01", 'descripcion' =>"ELEMENTOS Y EQUIPOS TRANSMISORES"),
            array('id' => 28, 'codigo' =>"01.26.01", 'descripcion' =>"RELOJES"),
            array('id' => 29, 'codigo' =>"01.27.01", 'descripcion' =>"ACONDICIONADORES AMBIENTALES"),
            array('id' => 30, 'codigo' =>"01.28.01", 'descripcion' =>"REFRIGERADORES"),
            array('id' => 31, 'codigo' =>"01.29.01", 'descripcion' =>"ELEMENTOS Y EQUIPOS DE SEGURIDAD"),
            array('id' => 32, 'codigo' =>"01.29.02", 'descripcion' =>"EXTINTORES"),
            array('id' => 33, 'codigo' =>"01.29.03", 'descripcion' =>"PROTECTOR CHEQUES / ESTAMPILLAS"),
            array('id' => 34, 'codigo' =>"01.29.04", 'descripcion' =>"CASETAS MOVILES P/GUARDIAS"),
            array('id' => 35, 'codigo' =>"01.30.01", 'descripcion' =>"ELEMENTOS Y EQUIPOS DE LABORATORIO"),
            array('id' => 36, 'codigo' =>"01.31.01", 'descripcion' =>"REFLECTORES"),
            array('id' => 37, 'codigo' =>"01.32.01", 'descripcion' =>"EQUIPO DE INTERCOMUNICACION"),
            array('id' => 38, 'codigo' =>"01.33.01", 'descripcion' =>"COCINAS"),
            array('id' => 39, 'codigo' =>"01.34.01", 'descripcion' =>"MAQUINAS FOTOCOPIADORAS"),
            array('id' => 40, 'codigo' =>"01.35.01", 'descripcion' =>"BRUJULAS"),
            array('id' => 41, 'codigo' =>"01.36.01", 'descripcion' =>"MICROCOMPUTADORES"),
            array('id' => 42, 'codigo' =>"01.36.02", 'descripcion' =>"MONITORES PARA PC"),
            array('id' => 43, 'codigo' =>"01.36.03", 'descripcion' =>"MESA Y TABLETA DIGITALIZADORA"),
            array('id' => 44, 'codigo' =>"01.36.04", 'descripcion' =>"EQUIPO COPIADOR DE CD ROM"),
            array('id' => 45, 'codigo' =>"01.36.05", 'descripcion' =>"DISQUETERA EXTERNA, ZIP Y CD ROM"),
            array('id' => 46, 'codigo' =>"01.36.06", 'descripcion' =>"DATA SWITCH, HUB Y PATCH PANEL"),
            array('id' => 47, 'codigo' =>"01.36.07", 'descripcion' =>"CAMARA VIDEO CONFERENCIA PARA PC"),
            array('id' => 48, 'codigo' =>"01.36.08", 'descripcion' =>"LECTOR DE CODIGO DE BARRAS"),
            array('id' => 49, 'codigo' =>"01.36.09", 'descripcion' =>"NOTEBOOK"),
            array('id' => 50, 'codigo' =>"01.37.01", 'descripcion' =>"IMPRESORAS"),
            array('id' => 51, 'codigo' =>"01.37.02", 'descripcion' =>"ALIMENTADOR AUTOMATICO DE PAPEL"),
            array('id' => 52, 'codigo' =>"01.38.01", 'descripcion' =>"MODEMS"),
            array('id' => 53, 'codigo' =>"01.39.01", 'descripcion' =>"MOUSE"),
            array('id' => 54, 'codigo' =>"01.40.01", 'descripcion' =>"PLOTTERS"),
            array('id' => 55, 'codigo' =>"01.41.01", 'descripcion' =>"TERMINALES DE COMPUTACION"),
            array('id' => 56, 'codigo' =>"01.42.01", 'descripcion' =>"FAXS"),
            array('id' => 57, 'codigo' =>"01.43.01", 'descripcion' =>"ELEMENTOS Y EQUIPOS DE DIBUJO"),
            array('id' => 58, 'codigo' =>"01.44.01", 'descripcion' =>"ELEMENTOS Y EQUIPOS DE RETROPROYECCION"),
            array('id' => 59, 'codigo' =>"01.44.02", 'descripcion' =>"PUNTEROS LASER, OTROS"),
            array('id' => 60, 'codigo' =>"01.44.03", 'descripcion' =>"TELONES DE PROYECCION"),
            array('id' => 61, 'codigo' =>"01.44.04", 'descripcion' =>"RETROPROYECTOR DE TRANSPARENCIAS"),
            array('id' => 62, 'codigo' =>"01.44.05", 'descripcion' =>"PROYECTOR DE DIAPOSITIVAS"),
            array('id' => 63, 'codigo' =>"01.44.06", 'descripcion' =>"EQUIPO DE MICROFICHAS"),
            array('id' => 64, 'codigo' =>"01.45.01", 'descripcion' =>"CALEFONTS - TERMOS"),
            array('id' => 65, 'codigo' =>"01.45.03", 'descripcion' =>"CALDERA"),
            array('id' => 66, 'codigo' =>"01.46.01", 'descripcion' =>"ELEMENTOS Y EQUIPOS DE COMPUTACION"),
            array('id' => 67, 'codigo' =>"01.46.02", 'descripcion' =>"DATA SHOW"),
            array('id' => 68, 'codigo' =>"01.46.03", 'descripcion' =>"SCANNER"),
            array('id' => 69, 'codigo' =>"01.99.01", 'descripcion' =>"OTROS"),
            array('id' => 70, 'codigo' =>"02.01.01", 'descripcion' =>"ESTANTES BIBLIOTECAS"),
            array('id' => 71, 'codigo' =>"02.02.01", 'descripcion' =>"BUTACAS"),
            array('id' => 72, 'codigo' =>"02.03.01", 'descripcion' =>"CAMAS O CAMILLAS"),
            array('id' => 73, 'codigo' =>"02.04.01", 'descripcion' =>"CARROS"),
            array('id' => 74, 'codigo' =>"02.05.01", 'descripcion' =>"ESCRITORIO MADERA 1 CAJON"),
            array('id' => 75, 'codigo' =>"02.05.02", 'descripcion' =>"ESCRITORIO MADERA 2 CAJONES"),
            array('id' => 76, 'codigo' =>"02.05.03", 'descripcion' =>"ESCRITORIO MADERA 3 CAJONES"),
            array('id' => 77, 'codigo' =>"02.05.04", 'descripcion' =>"ESCRITORIO MADERA 4 CAJONES"),
            array('id' => 78, 'codigo' =>"02.05.05", 'descripcion' =>"ESCRITORIO MADERA 5 CAJONES"),
            array('id' => 79, 'codigo' =>"02.05.06", 'descripcion' =>"ESCRITORIO MADERA 6 CAJONES"),
            array('id' => 80, 'codigo' =>"02.05.07", 'descripcion' =>"ESCRITORIO METALICO 1 CAJON"),
            array('id' => 81, 'codigo' =>"02.05.08", 'descripcion' =>"ESCRITORIO METALICO 2 CAJONES"),
            array('id' => 82, 'codigo' =>"02.05.09", 'descripcion' =>"ESCRITORIO METALICO 3 CAJONES"),
            array('id' => 83, 'codigo' =>"02.05.10", 'descripcion' =>"ESCRITORIO METALICO 4 CAJONES"),
            array('id' => 84, 'codigo' =>"02.05.11", 'descripcion' =>"ESCRITORIO METALICO 5 CAJONES"),
            array('id' => 85, 'codigo' =>"02.05.12", 'descripcion' =>"ESCRITORIO METALICO 6 CAJONES"),
            array('id' => 86, 'codigo' =>"02.05.13", 'descripcion' =>"ESCRITORIO DE LUJO"),
            array('id' => 87, 'codigo' =>"02.05.14", 'descripcion' =>"ESCRITORIO ESTACION DE TRABAJO"),
            array('id' => 88, 'codigo' =>"02.06.01", 'descripcion' =>"GUARDARROPAS O CLOSET"),
            array('id' => 89, 'codigo' =>"02.07.01", 'descripcion' =>"SILLA GIRATORIA"),
            array('id' => 90, 'codigo' =>"02.07.02", 'descripcion' =>"SILLA METALICA FIJA"),
            array('id' => 91, 'codigo' =>"02.07.03", 'descripcion' =>"SILLA MADERA FIJA"),
            array('id' => 92, 'codigo' =>"02.08.01", 'descripcion' =>"SILLON FIJO"),
            array('id' => 93, 'codigo' =>"02.08.02", 'descripcion' =>"SILLON GIRATORIO"),
            array('id' => 94, 'codigo' =>"02.08.03", 'descripcion' =>"SILLON LIVING"),
            array('id' => 95, 'codigo' =>"02.09.01", 'descripcion' =>"SOFAES 2 CUERPOS"),
            array('id' => 96, 'codigo' =>"02.09.02", 'descripcion' =>"SOFAES 3 CUERPOS"),
            array('id' => 97, 'codigo' =>"02.10.01", 'descripcion' =>"TARJETEROS O FICHEROS DE GAVETAS"),
            array('id' => 98, 'codigo' =>"02.11.01", 'descripcion' =>"BANCOS O BANQUETAS"),
            array('id' => 99, 'codigo' =>"02.11.02", 'descripcion' =>"BANCOS CARPINTEROS"),
            array('id' => 100, 'codigo' =>"02.12.01", 'descripcion' =>"ESTANTES O GABINETES DE MADERA"),
            array('id' => 101, 'codigo' =>"02.12.02", 'descripcion' =>"ESTANTES O GABINETES DE METALICOS"),
            array('id' => 102, 'codigo' =>"02.12.03", 'descripcion' =>"ESTANTES O ARMARIOS  DE MADERA"),
            array('id' => 103, 'codigo' =>"02.12.04", 'descripcion' =>"ESTANTES O ARMARIOS  DE METALICOS"),
            array('id' => 104, 'codigo' =>"02.12.05", 'descripcion' =>"ESTANTERIAS MADERA O REPISAS"),
            array('id' => 105, 'codigo' =>"02.12.06", 'descripcion' =>"ESTANTERIAS METALICA O REPISAS"),
            array('id' => 106, 'codigo' =>"02.12.07", 'descripcion' =>"ESTANTE ARCHIVO, COLGANTE, MADERA"),
            array('id' => 107, 'codigo' =>"02.12.08", 'descripcion' =>"ESTANTE BASE MADERA"),
            array('id' => 108, 'codigo' =>"02.12.09", 'descripcion' =>"ESTANTE BASE METALICO"),
            array('id' => 109, 'codigo' =>"02.13.01", 'descripcion' =>"SILLAS DE RUEDAS"),
            array('id' => 110, 'codigo' =>"02.14.01", 'descripcion' =>"KARDEX MADERA 3 CAJONES"),
            array('id' => 111, 'codigo' =>"02.14.02", 'descripcion' =>"KARDEX MADERA 4 CAJONES"),
            array('id' => 112, 'codigo' =>"02.14.03", 'descripcion' =>"KARDEX METALICO 3 CAJONES"),
            array('id' => 113, 'codigo' =>"02.14.04", 'descripcion' =>"KARDEX METALICO 4 CAJONES"),
            array('id' => 114, 'codigo' =>"02.15.01", 'descripcion' =>"MESA MADERA"),
            array('id' => 115, 'codigo' =>"02.15.02", 'descripcion' =>"MESA METALICA"),
            array('id' => 116, 'codigo' =>"02.15.03", 'descripcion' =>"MESA DE DIBUJO"),
            array('id' => 117, 'codigo' =>"02.15.04", 'descripcion' =>"MESA DE REUNION"),
            array('id' => 118, 'codigo' =>"02.16.01", 'descripcion' =>"MESONES DE MADERA"),
            array('id' => 119, 'codigo' =>"02.16.02", 'descripcion' =>"MESONES METALICOS"),
            array('id' => 120, 'codigo' =>"02.17.01", 'descripcion' =>"PERCHEROS Y PARAGUEROS MADERA"),
            array('id' => 121, 'codigo' =>"02.17.02", 'descripcion' =>"PERCHEROS Y PARAGUEROS METALICOS"),
            array('id' => 122, 'codigo' =>"02.17.03", 'descripcion' =>"PAPELERO/CENICERO METALICO"),
            array('id' => 123, 'codigo' =>"02.18.01", 'descripcion' =>"PISOS Y POUFS"),
            array('id' => 124, 'codigo' =>"02.19.01", 'descripcion' =>"VELADORES MADERA"),
            array('id' => 125, 'codigo' =>"02.19.02", 'descripcion' =>"VELADORES METALICOS"),
            array('id' => 126, 'codigo' =>"02.20.01", 'descripcion' =>"ESTANTES VITRINAS"),
            array('id' => 127, 'codigo' =>"02.21.01", 'descripcion' =>"PIZARRONES ACRILICO"),
            array('id' => 128, 'codigo' =>"02.21.02", 'descripcion' =>"ROTAFOLIO O PAPELOGRAFO"),
            array('id' => 129, 'codigo' =>"02.21.03", 'descripcion' =>"PIZARRA MAGNETICA"),
            array('id' => 130, 'codigo' =>"02.22.01", 'descripcion' =>"UTILES DE MUSEO"),
            array('id' => 131, 'codigo' =>"02.23.01", 'descripcion' =>"UTILES DE EXPOSICION"),
            array('id' => 132, 'codigo' =>"02.24.01", 'descripcion' =>"INSTRUMENTOS MUSICALES"),
            array('id' => 133, 'codigo' =>"02.25.01", 'descripcion' =>"ELEMENTOS DEPORTIVOS"),
            array('id' => 134, 'codigo' =>"02.26.01", 'descripcion' =>"BALONES DE GAS"),
            array('id' => 135, 'codigo' =>"02.27.01", 'descripcion' =>"ASPIRADORAS ELECTRICAS (SOPLADORES)"),
            array('id' => 136, 'codigo' =>"02.27.02", 'descripcion' =>"ASPIRADORAS SEMI-INDUSTRIALES"),
            array('id' => 137, 'codigo' =>"02.28.01", 'descripcion' =>"ENCERADORES ELECTRICOS"),
            array('id' => 138, 'codigo' =>"02.28.02", 'descripcion' =>"ENCERADORAS SEMI-INDUSTRIALES"),
            array('id' => 139, 'codigo' =>"02.29.01", 'descripcion' =>"ESTUFAS GAS LICUADO"),
            array('id' => 140, 'codigo' =>"02.29.02", 'descripcion' =>"ESTUFA O CALEFACTOR ELECTRICO"),
            array('id' => 141, 'codigo' =>"02.30.01", 'descripcion' =>"RADIO RECEPTORES"),
            array('id' => 142, 'codigo' =>"02.30.02", 'descripcion' =>"GRABADOR(A)"),
            array('id' => 143, 'codigo' =>"02.31.01", 'descripcion' =>"TOCADISCOS"),
            array('id' => 144, 'codigo' =>"02.32.01", 'descripcion' =>"BATIDORAS, JUGUERAS"),
            array('id' => 145, 'codigo' =>"02.33.01", 'descripcion' =>"SECADORES"),
            array('id' => 146, 'codigo' =>"02.34.01", 'descripcion' =>"VENTILADORES Y EXTRACTORES"),
            array('id' => 147, 'codigo' =>"02.36.01", 'descripcion' =>"TELEVISORES COLOR"),
            array('id' => 148, 'codigo' =>"02.37.01", 'descripcion' =>"PLANCHAS ELECTRICAS"),
            array('id' => 149, 'codigo' =>"02.38.01", 'descripcion' =>"LAMPARAS DE SOBREMESA"),
            array('id' => 150, 'codigo' =>"02.38.02", 'descripcion' =>"LAMPARAS DE PEDESTAL"),
            array('id' => 151, 'codigo' =>"02.39.01", 'descripcion' =>"BOTIQUINES"),
            array('id' => 152, 'codigo' =>"02.40.01", 'descripcion' =>"EQUIPOS DE AUDIO"),
            array('id' => 153, 'codigo' =>"02.40.02", 'descripcion' =>"BAFLES Y PARLANTES"),
            array('id' => 154, 'codigo' =>"02.40.03", 'descripcion' =>"MICROFONOS Y PEDESTALES"),
            array('id' => 155, 'codigo' =>"02.41.01", 'descripcion' =>"EQUIPOS DE VIDEO"),
            array('id' => 156, 'codigo' =>"02.42.01", 'descripcion' =>"VITRINA MURAL/ DIARIO MURAL MADERA"),
            array('id' => 157, 'codigo' =>"02.42.02", 'descripcion' =>"VITRINA MURAL/ DIARIO MURAL METALICO"),
            array('id' => 158, 'codigo' =>"02.43.01", 'descripcion' =>"CAJA DE FONDO METALICA"),
            array('id' => 159, 'codigo' =>"02.43.02", 'descripcion' =>"CAJA METALICA (CAJA CHICA)"),
            array('id' => 160, 'codigo' =>"02.44.01", 'descripcion' =>"CAJA PORTA DISKETTES"),
            array('id' => 161, 'codigo' =>"02.44.02", 'descripcion' =>"CAJA PORTA DIAPOSITIVAS "),
            array('id' => 162, 'codigo' =>"02.44.03", 'descripcion' =>"CAJA METALICA RACK"),
            array('id' => 163, 'codigo' =>"02.44.04", 'descripcion' =>"CAJA/MALETIN PORTA HERRAMIENTAS"),
            array('id' => 164, 'codigo' =>"02.45.01", 'descripcion' =>"MODULO DE MADERA P/LECTURA"),
            array('id' => 165, 'codigo' =>"02.45.02", 'descripcion' =>"MODULO METALICO P/LECTURA"),
            array('id' => 166, 'codigo' =>"02.45.03", 'descripcion' =>"MODULO DE MADERA P/TRABAJO"),
            array('id' => 167, 'codigo' =>"02.46.01", 'descripcion' =>"BIOMBOS O SEPARADORES DE AMBIENTE"),
            array('id' => 168, 'codigo' =>"02.47.01", 'descripcion' =>"PODIUMS"),
            array('id' => 169, 'codigo' =>"02.48.01", 'descripcion' =>"MUEBLES DE COCINA MADERA"),
            array('id' => 170, 'codigo' =>"02.48.02", 'descripcion' =>"MUEBLES DE COCINA METALICO"),
            array('id' => 171, 'codigo' =>"02.49.01", 'descripcion' =>"PLANERA MADERA"),
            array('id' => 172, 'codigo' =>"02.49.02", 'descripcion' =>"PLANERA METALICA"),
            array('id' => 173, 'codigo' =>"02.50.01", 'descripcion' =>"MAPAS Y GLOBOS TERRAQUEOS"),
            array('id' => 174, 'codigo' =>"02.51.01", 'descripcion' =>"CORCHETERAS SEMI-INDUSTRIALES"),
            array('id' => 175, 'codigo' =>"02.52.01", 'descripcion' =>"TIMBRES Y FOLIADOR"),
            array('id' => 176, 'codigo' =>"02.53.01", 'descripcion' =>"CIERRA PUERTA"),
            array('id' => 177, 'codigo' =>"02.99.01", 'descripcion' =>"OTROS"),
            array('id' => 178, 'codigo' =>"03.01.01", 'descripcion' =>"AUTOMOVILES"),
            array('id' => 179, 'codigo' =>"03.02.01", 'descripcion' =>"CAMIONETAS"),
            array('id' => 180, 'codigo' =>"03.03.01", 'descripcion' =>"CAMIONES"),
            array('id' => 181, 'codigo' =>"03.04.01", 'descripcion' =>"MOTOS"),
            array('id' => 182, 'codigo' =>"03.05.01", 'descripcion' =>"MICROBUSES"),
            array('id' => 183, 'codigo' =>"03.06.01", 'descripcion' =>"TAXIBUSES"),
            array('id' => 184, 'codigo' =>"03.07.01", 'descripcion' =>"JEEPS"),
            array('id' => 185, 'codigo' =>"03.08.01", 'descripcion' =>"STATION WAGON Y SIMILARES (VENTAN)"),
            array('id' => 186, 'codigo' =>"03.09.01", 'descripcion' =>"FURGONES Y SIMILARES (CERRADOS)"),
            array('id' => 187, 'codigo' =>"03.10.01", 'descripcion' =>"CASAS RODANTES"),
            array('id' => 188, 'codigo' =>"03.11.01", 'descripcion' =>"LANCHAS"),
            array('id' => 189, 'codigo' =>"03.12.01", 'descripcion' =>"TRICICLOS"),
            array('id' => 190, 'codigo' =>"03.13.01", 'descripcion' =>"BICICLETAS"),
            array('id' => 191, 'codigo' =>"03.14.01", 'descripcion' =>"MINIBUSES"),
            array('id' => 192, 'codigo' =>"03.99.01", 'descripcion' =>"OTROS"),
            array('id' => 193, 'codigo' =>"04.01.01", 'descripcion' =>"TALADROS"),
            array('id' => 194, 'codigo' =>"04.02.01", 'descripcion' =>"TECLES"),
            array('id' => 195, 'codigo' =>"04.03.01", 'descripcion' =>"CEPILLADORAS"),
            array('id' => 196, 'codigo' =>"04.04.01", 'descripcion' =>"ESMERILES"),
            array('id' => 197, 'codigo' =>"04.05.01", 'descripcion' =>"REBAJADORAS"),
            array('id' => 198, 'codigo' =>"04.06.01", 'descripcion' =>"HUINCHAS"),
            array('id' => 199, 'codigo' =>"04.07.01", 'descripcion' =>"CEPILLOS CARPINTEROS"),
            array('id' => 200, 'codigo' =>"04.08.01", 'descripcion' =>"TORNILLOS MECANICOS"),
            array('id' => 201, 'codigo' =>"04.09.01", 'descripcion' =>"CARRETILLAS"),
            array('id' => 202, 'codigo' =>"04.10.01", 'descripcion' =>"BETONERAS"),
            array('id' => 203, 'codigo' =>"04.11.01", 'descripcion' =>"LIJADORAS DE BANDA"),
            array('id' => 204, 'codigo' =>"04.11.02", 'descripcion' =>"LIJADORAS ORBITALES"),
            array('id' => 205, 'codigo' =>"04.12.01", 'descripcion' =>"SIERRAS"),
            array('id' => 206, 'codigo' =>"04.13.01", 'descripcion' =>"CIZALLAS"),
            array('id' => 207, 'codigo' =>"04.14.01", 'descripcion' =>"ATORNILLADORES RECARGABLES"),
            array('id' => 208, 'codigo' =>"04.15.01", 'descripcion' =>"FRAGUAS MANUALES"),
            array('id' => 209, 'codigo' =>"04.15.02", 'descripcion' =>"FRAGUAS ELECTRICAS"),
            array('id' => 210, 'codigo' =>"04.16.01", 'descripcion' =>"TORNOS DE MADERA"),
            array('id' => 211, 'codigo' =>"04.16.02", 'descripcion' =>"TORNETAS MANUALES"),
            array('id' => 212, 'codigo' =>"04.16.03", 'descripcion' =>"TORNOS "),
            array('id' => 213, 'codigo' =>"04.17.01", 'descripcion' =>"MAQUINAS MULTIPLES"),
            array('id' => 214, 'codigo' =>"04.18.01", 'descripcion' =>"MAQUINA TUPY"),
            array('id' => 215, 'codigo' =>"04.18.02", 'descripcion' =>"MAQUINA CANTEADORA"),
            array('id' => 216, 'codigo' =>"04.18.03", 'descripcion' =>"MAQUINA PLEGADORA"),
            array('id' => 217, 'codigo' =>"04.18.04", 'descripcion' =>"MAQUINA CURVATURA"),
            array('id' => 218, 'codigo' =>"04.19.01", 'descripcion' =>"CORCHETERAS NEUMATICAS"),
            array('id' => 219, 'codigo' =>"04.19.02", 'descripcion' =>"CORCHETERAS P/CABLES ELECTRICOS"),
            array('id' => 220, 'codigo' =>"04.19.03", 'descripcion' =>"HERRAMIENTA P/REGLETA BIX"),
            array('id' => 221, 'codigo' =>"04.19.04", 'descripcion' =>"HERRAMIENTA P/REGLETA KRONE"),
            array('id' => 222, 'codigo' =>"04.19.05", 'descripcion' =>"HERRAMIENTA P/TELEFONIA"),
            array('id' => 223, 'codigo' =>"04.20.01", 'descripcion' =>"PRENSAS HIDRAULICAS"),
            array('id' => 224, 'codigo' =>"04.20.02", 'descripcion' =>"PRENSA CARPINTERA (SARGENTOS)"),
            array('id' => 225, 'codigo' =>"04.21.01", 'descripcion' =>"COMBOS"),
            array('id' => 226, 'codigo' =>"04.22.01", 'descripcion' =>"CALADORA"),
            array('id' => 227, 'codigo' =>"04.23.01", 'descripcion' =>"ESCALAS O ESCALERAS"),
            array('id' => 228, 'codigo' =>"04.24.01", 'descripcion' =>"PERFORADORA SEMI-INDUSTRIAL"),
            array('id' => 229, 'codigo' =>"04.25.01", 'descripcion' =>"SOPLETES A GAS LICUADO"),
            array('id' => 230, 'codigo' =>"04.26.01", 'descripcion' =>"VIGORNIAS DE ACERO"),
            array('id' => 231, 'codigo' =>"04.27.01", 'descripcion' =>"ROEDORAS"),
            array('id' => 232, 'codigo' =>"04.28.01", 'descripcion' =>"JUEGOS DE DADO"),
            array('id' => 233, 'codigo' =>"04.29.01", 'descripcion' =>"CORTADORAS DE CERAMICA"),
            array('id' => 234, 'codigo' =>"04.30.01", 'descripcion' =>"LLAVES DE TORQUE"),
            array('id' => 235, 'codigo' =>"04.31.01", 'descripcion' =>"MOLDES Y MATRICES"),
            array('id' => 236, 'codigo' =>"04.32.01", 'descripcion' =>"PIZONES COMPACTADORES"),
            array('id' => 237, 'codigo' =>"04.32.02", 'descripcion' =>"VIBRADOR ELECTRICO P/HORMIGONES"),
            array('id' => 238, 'codigo' =>"04.99.01", 'descripcion' =>"OTROS"),

            


        ]);
    }

}

class CuentaContableTableSeeder extends Seeder {

    public function run()
    {
        DB::table('cuenta_contable')->delete();

        DB::table('cuenta_contable')->insert([
            array('id' => 1, 'codigo' =>"102005001", 'nombre' =>"MUEBLES Y EQUIPOS DE OFICINA", 'vida_util' =>"10"),
            array('id' => 2, 'codigo' =>"102003001", 'nombre' =>"EQUIPAMIENTO DE SALAS", 'vida_util' =>"10"),
            array('id' => 3, 'codigo' =>"102003002", 'nombre' =>"EQUIPOS E INSTRUMENTOS TECNICOS", 'vida_util' =>"20"),
            array('id' => 4, 'codigo' =>"102003003", 'nombre' =>"LABORATORIOS", 'vida_util' =>"20"),
            array('id' => 5, 'codigo' =>"102003004", 'nombre' =>"HERRAMIENTAS", 'vida_util' =>"10"),
            array('id' => 6, 'codigo' =>"102003005", 'nombre' =>"EQUIPOS Y ELEMENTOS DE COMPUTACION", 'vida_util' =>"6"),
            array('id' => 7, 'codigo' =>"102003006", 'nombre' =>"LICENCIA", 'vida_util' =>"5"),
            array('id' => 8, 'codigo' =>"102004001", 'nombre' =>"VEHICULOS", 'vida_util' =>"10"),

        ]);
    }

}

