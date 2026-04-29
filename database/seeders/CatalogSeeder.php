<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CatalogSeeder extends Seeder
{
    /**
     * Seed the catalog from the course spreadsheet (30 books, CRC).
     */
    public function run(): void
    {
        $categoryNames = [
            'Novela',
            'Infantil',
            'Ciencia ficción',
            'Fantasía',
            'Romance',
            'Autoayuda',
            'Educación',
            'Historia',
            'Suspenso',
            'Terror',
            'Tecnología',
        ];
        $slugByName = [];
        foreach ($categoryNames as $name) {
            $cat = Category::query()->firstOrCreate([
                'slug' => Str::slug($name),
            ], [
                'name' => $name,
            ]);
            $slugByName[$name] = $cat->id;
        }
        $rows = [
            ['Novela', 'Cien años de soledad', 'Gabriel García Márquez', 'Editorial Sudamericana', 8500, 'Español', 'Físico', 471, '9780307474728', 1967, 12, 'Disponible', 102000, 'cien_anos_soledad.jpg', 'Novela representativa del realismo mágico que narra la historia de la familia Buendía'],
            ['Infantil', 'El Principito', 'Antoine de Saint-Exupéry', 'Salamandra', 5500, 'Español', 'Físico', 96, '9780156012195', 1943, 20, 'Disponible', 110000, 'el_principito.jpg', 'Relato filosófico y poético sobre la amistad la infancia y el sentido de la vida'],
            ['Novela', 'Don Quijote de la Mancha', 'Miguel de Cervantes', 'Alfaguara', 12000, 'Español', 'Físico', 863, '9788420412146', 1605, 8, 'Disponible', 96000, 'don_quijote.jpg', 'Obra clásica de la literatura española sobre las aventuras de Don Quijote y Sancho Panza'],
            ['Ciencia ficción', '1984', 'George Orwell', 'Debolsillo', 7800, 'Español', 'Físico', 352, '9788499890944', 1949, 15, 'Disponible', 117000, '1984.jpg', 'Novela distópica sobre vigilancia control social y manipulación política'],
            ['Novela', 'Rebelión en la granja', 'George Orwell', 'Debolsillo', 6200, 'Español', 'Físico', 144, '9788499890951', 1945, 17, 'Disponible', 105400, 'rebelion_granja.jpg', 'Fábula política sobre el poder la corrupción y la manipulación social'],
            ['Ciencia ficción', 'Fahrenheit 451', 'Ray Bradbury', 'Minotauro', 7900, 'Español', 'Físico', 256, '9788445074870', 1953, 10, 'Disponible', 79000, 'fahrenheit_451.jpg', 'Novela distópica donde los libros son prohibidos y quemados por el Estado'],
            ['Fantasía', 'Harry Potter y la piedra filosofal', 'J.K. Rowling', 'Salamandra', 9500, 'Español', 'Físico', 256, '9788478884452', 1997, 18, 'Disponible', 171000, 'harry_potter_piedra_filosofal.jpg', 'Primer libro de la saga donde Harry descubre que es mago'],
            ['Fantasía', 'Harry Potter y la cámara secreta', 'J.K. Rowling', 'Salamandra', 9800, 'Español', 'Físico', 288, '9788478884957', 1998, 14, 'Disponible', 137200, 'harry_potter_camara_secreta.jpg', 'Segunda aventura de Harry Potter en Hogwarts'],
            ['Fantasía', 'El Hobbit', 'J.R.R. Tolkien', 'Minotauro', 8900, 'Español', 'Físico', 320, '9788445000657', 1937, 16, 'Disponible', 142400, 'el_hobbit.jpg', 'Historia de Bilbo Bolsón y su viaje junto a un grupo de enanos'],
            ['Fantasía', 'El señor de los anillos La comunidad del anillo', 'J.R.R. Tolkien', 'Minotauro', 11500, 'Español', 'Físico', 576, '9788445000664', 1954, 9, 'Disponible', 103500, 'la_comunidad_del_anillo.jpg', 'Primera parte de la aventura para destruir el Anillo Único'],
            ['Romance', 'Orgullo y prejuicio', 'Jane Austen', 'Alma', 7200, 'Español', 'Físico', 432, '9788418008054', 1813, 13, 'Disponible', 93600, 'orgullo_prejuicio.jpg', 'Novela romántica clásica sobre Elizabeth Bennet y el señor Darcy'],
            ['Romance', 'Jane Eyre', 'Charlotte Brontë', 'Alma', 7600, 'Español', 'Físico', 624, '9788418008061', 1847, 7, 'Disponible', 53200, 'jane_eyre.jpg', 'Novela de formación romance e independencia personal'],
            ['Ciencia ficción', 'Los juegos del hambre', 'Suzanne Collins', 'RBA', 8700, 'Español', 'Físico', 400, '9788427202122', 2008, 11, 'Disponible', 95700, 'juegos_hambre.jpg', 'Novela juvenil distópica sobre supervivencia y control social'],
            ['Ciencia ficción', 'En llamas', 'Suzanne Collins', 'RBA', 8700, 'Español', 'Físico', 416, '9788427202139', 2009, 8, 'Disponible', 69600, 'en_llamas.jpg', 'Segunda parte de la trilogía Los juegos del hambre'],
            ['Ciencia ficción', 'Sinsajo', 'Suzanne Collins', 'RBA', 8700, 'Español', 'Físico', 424, '9788427202146', 2010, 6, 'Disponible', 52200, 'sinsajo.jpg', 'Tercera parte de la trilogía Los juegos del hambre'],
            ['Autoayuda', 'Hábitos atómicos', 'James Clear', 'Diana Editorial', 10500, 'Español', 'Físico', 336, '9786077476713', 2018, 20, 'Disponible', 210000, 'habitos_atomicos.jpg', 'Libro de desarrollo personal sobre pequeños hábitos y mejora continua'],
            ['Autoayuda', 'El poder del ahora', 'Eckhart Tolle', 'Gaia Ediciones', 9800, 'Español', 'Físico', 256, '9788484452063', 1997, 9, 'Disponible', 88200, 'poder_del_ahora.jpg', 'Libro de crecimiento personal sobre conciencia y vida en el presente'],
            ['Educación', 'Padre rico padre pobre', 'Robert Kiyosaki', 'Aguilar', 9900, 'Español', 'Físico', 240, '9781612680194', 1997, 15, 'Disponible', 148500, 'padre_rico_padre_pobre.jpg', 'Libro sobre educación financiera y mentalidad económica'],
            ['Historia', 'Steve Jobs', 'Walter Isaacson', 'Debate', 12500, 'Español', 'Físico', 744, '9788499921181', 2011, 5, 'Disponible', 62500, 'steve_jobs.jpg', 'Biografía del fundador de Apple basada en entrevistas y testimonios'],
            ['Historia', 'Sapiens De animales a dioses', 'Yuval Noah Harari', 'Debate', 11800, 'Español', 'Físico', 496, '9788499926223', 2011, 12, 'Disponible', 141600, 'sapiens.jpg', 'Ensayo histórico sobre la evolución de la humanidad'],
            ['Historia', 'Homo Deus', 'Yuval Noah Harari', 'Debate', 11900, 'Español', 'Físico', 496, '9788499926711', 2015, 10, 'Disponible', 119000, 'homo_deus.jpg', 'Análisis sobre el futuro de la humanidad la tecnología y la inteligencia artificial'],
            ['Suspenso', 'El código Da Vinci', 'Dan Brown', 'Planeta', 8900, 'Español', 'Físico', 656, '9788408172176', 2003, 13, 'Disponible', 115700, 'codigo_da_vinci.jpg', 'Novela de misterio sobre símbolos secretos arte e historia'],
            ['Suspenso', 'Ángeles y demonios', 'Dan Brown', 'Planeta', 8900, 'Español', 'Físico', 608, '9788408054991', 2000, 8, 'Disponible', 71200, 'angeles_demonios.jpg', 'Novela de suspenso protagonizada por Robert Langdon'],
            ['Suspenso', 'La chica del tren', 'Paula Hawkins', 'Planeta', 8500, 'Español', 'Físico', 496, '9788408141479', 2015, 7, 'Disponible', 59500, 'chica_del_tren.jpg', 'Thriller psicológico sobre una mujer que observa una desaparición desde el tren'],
            ['Terror', 'It', 'Stephen King', 'Debolsillo', 13500, 'Español', 'Físico', 1504, '9788497593793', 1986, 4, 'Disponible', 54000, 'it.jpg', 'Novela de terror sobre una entidad que atemoriza a un grupo de niños'],
            ['Terror', 'Carrie', 'Stephen King', 'Debolsillo', 7200, 'Español', 'Físico', 256, '9788497595698', 1974, 6, 'Disponible', 43200, 'carrie.jpg', 'Novela de terror sobre una joven con poderes telequinéticos'],
            ['Tecnología', 'Programación en Java', 'Herbert Schildt', 'McGraw Hill', 18500, 'Español', 'Físico', 720, '9786071514121', 2019, 5, 'Disponible', 92500, 'programacion_java.jpg', 'Libro introductorio sobre conceptos de programación usando Java'],
            ['Tecnología', 'Clean Code', 'Robert C. Martin', 'Prentice Hall', 22000, 'Inglés', 'Físico', 464, '9780132350884', 2008, 6, 'Disponible', 132000, 'clean_code.jpg', 'Libro sobre buenas prácticas para escribir código limpio y mantenible'],
            ['Tecnología', 'HTML and CSS Design and Build Websites', 'Jon Duckett', 'Wiley', 17500, 'Inglés', 'Físico', 490, '9781118008188', 2011, 9, 'Disponible', 157500, 'html_css_duckett.jpg', 'Guía visual para aprender estructura y estilos de sitios web'],
            ['Historia', 'El arte de la guerra', 'Sun Tzu', 'Obelisco', 5900, 'Español', 'Físico', 128, '9788497776097', 500, 18, 'Disponible', 106200, 'arte_guerra.jpg', 'Obra clásica sobre estrategia liderazgo y toma de decisiones'],
        ];
        foreach ($rows as $r) {
            Book::query()->updateOrCreate([
                'isbn' => $r[8],
            ], [
                'category_id' => $slugByName[$r[0]],
                'title' => $r[1],
                'author' => $r[2],
                'publisher' => $r[3],
                'price' => $r[4],
                'currency' => 'CRC',
                'language' => $r[5],
                'format' => $r[6],
                'pages' => $r[7],
                'isbn' => $r[8],
                'publication_year' => $r[9],
                'stock' => $r[10],
                'status' => $r[11],
                'inventory_value' => $r[12],
                'image_filename' => $r[13],
                'description' => $r[14],
            ]);
        }
    }
}
