<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all()->keyBy('name');

        $products = [
            // 1. Electrónica
            [
                'name' => 'Smartphone Galaxy Pro',
                'description' => 'Teléfono inteligente de alta gama con pantalla AMOLED de 6.7 pulgadas.',
                'price' => 799.99,
                'stock' => 25,
                'category_name' => 'Electrónica',
            ],
            [
                'name' => 'Auriculares Inalámbricos Noise Cancelling',
                'description' => 'Auriculares bluetooth con cancelación activa de ruido y 30h de batería.',
                'price' => 149.50,
                'stock' => 40,
                'category_name' => 'Electrónica',
            ],
            [
                'name' => 'Smart TV 55" 4K UHD',
                'description' => 'Televisor inteligente con HDR10 y soporte para aplicaciones de streaming.',
                'price' => 549.00,
                'stock' => 15,
                'category_name' => 'Electrónica',
            ],

            // 2. Ropa
            [
                'name' => 'Camiseta Básica de Algodón',
                'description' => 'Camiseta 100% algodón suave y transpirable, corte clásico unisex.',
                'price' => 19.99,
                'stock' => 100,
                'category_name' => 'Ropa',
            ],
            [
                'name' => 'Pantalón Jean Slim Fit',
                'description' => 'Pantalón de mezclilla resistente y elástica con acabado moderno.',
                'price' => 49.90,
                'stock' => 60,
                'category_name' => 'Ropa',
            ],
            [
                'name' => 'Chaqueta Impermeable Cortavientos',
                'description' => 'Chaqueta ligera resistente al viento y lluvia ligera con capucha.',
                'price' => 89.00,
                'stock' => 35,
                'category_name' => 'Ropa',
            ],

            // 3. Hogar
            [
                'name' => 'Lámpara de Mesa LED Inteligente',
                'description' => 'Lámpara regulable con control táctil y múltiples temperaturas de color.',
                'price' => 34.99,
                'stock' => 50,
                'category_name' => 'Hogar',
            ],
            [
                'name' => 'Juego de Sábanas Queen 400 Hilos',
                'description' => 'Sábanas suaves de microfibra de alta calidad, hipoalergénicas.',
                'price' => 65.00,
                'stock' => 30,
                'category_name' => 'Hogar',
            ],
            [
                'name' => 'Cafetera de Goteo Programable',
                'description' => 'Cafetera automática con jarra térmica de 12 tazas y temporizador.',
                'price' => 59.99,
                'stock' => 20,
                'category_name' => 'Hogar',
            ],

            // 4. Juguetes
            [
                'name' => 'Set de Bloques Magnéticos 3D',
                'description' => 'Juego educativo de construcción magnética para estimular la creatividad.',
                'price' => 39.99,
                'stock' => 45,
                'category_name' => 'Juguetes',
            ],
            [
                'name' => 'Auto a Control Remoto Todo Terreno',
                'description' => 'Vehículo recargable a escala con amortiguación y velocidad de hasta 20 km/h.',
                'price' => 45.00,
                'stock' => 30,
                'category_name' => 'Juguetes',
            ],

            // 5. Deportes
            [
                'name' => 'Balón de Fútbol Profesional N° 5',
                'description' => 'Balón cosido a mano con cámara de látex de alta retención de aire.',
                'price' => 29.99,
                'stock' => 70,
                'category_name' => 'Deportes',
            ],
            [
                'name' => 'Tapete de Yoga Antideslizante 6mm',
                'description' => 'Esterilla ergonómica acolchada para yoga, pilates y ejercicios de suelo.',
                'price' => 24.50,
                'stock' => 80,
                'category_name' => 'Deportes',
            ],
            [
                'name' => 'Set de Mancuernas Ajustables 20kg',
                'description' => 'Par de mancuernas con discos intercambiables y barra extensora.',
                'price' => 119.00,
                'stock' => 25,
                'category_name' => 'Deportes',
            ],

            // 6. Alimentos
            [
                'name' => 'Café de Grano Especialidad 500g',
                'description' => 'Café arábica 100% de origen colombiano con notas achocolatadas.',
                'price' => 14.50,
                'stock' => 120,
                'category_name' => 'Alimentos',
            ],
            [
                'name' => 'Aceite de Oliva Extra Virgen 1L',
                'description' => 'Aceite prensado en frío de primera extracción, acidez menor a 0.2%.',
                'price' => 18.00,
                'stock' => 90,
                'category_name' => 'Alimentos',
            ],

            // 7. Belleza
            [
                'name' => 'Crema Facial con Ácido Hialurónico',
                'description' => 'Hidratante intensiva de absorción rápida para rostro y cuello.',
                'price' => 28.00,
                'stock' => 65,
                'category_name' => 'Belleza',
            ],
            [
                'name' => 'Serum Iluminador con Vitamina C',
                'description' => 'Serum facial antioxidante que unifica el tono y aporta luminosidad.',
                'price' => 32.50,
                'stock' => 50,
                'category_name' => 'Belleza',
            ],

            // 8. Salud
            [
                'name' => 'Multivitamínico Completo 90 Cápsulas',
                'description' => 'Suplemento diario con minerales y vitaminas para reforzar defensas.',
                'price' => 21.90,
                'stock' => 85,
                'category_name' => 'Salud',
            ],
            [
                'name' => 'Tensiómetro Digital de Brazo',
                'description' => 'Monitor de presión arterial automático con pantalla digital grande.',
                'price' => 42.00,
                'stock' => 30,
                'category_name' => 'Salud',
            ],

            // 9. Moda
            [
                'name' => 'Gafas de Sol Polarizadas UV400',
                'description' => 'Lentes de sol con protección UV400 y armazón ligero de acetato.',
                'price' => 35.00,
                'stock' => 75,
                'category_name' => 'Moda',
            ],
            [
                'name' => 'Reloj Minimalista Correa de Cuero',
                'description' => 'Reloj análogo clásico con esfera limpia y caja de acero inoxidable.',
                'price' => 79.99,
                'stock' => 40,
                'category_name' => 'Moda',
            ],

            // 10. Tecnología
            [
                'name' => 'Laptop Ultrabook 14" 16GB RAM',
                'description' => 'Portátil ultradelgada con SSD NVMe de 512GB y pantalla IPS Full HD.',
                'price' => 899.00,
                'stock' => 15,
                'category_name' => 'Tecnología',
            ],
            [
                'name' => 'Teclado Mecánico RGB Switch Red',
                'description' => 'Teclado para gaming y oficina con teclas silenciosas e iluminación RGB.',
                'price' => 69.90,
                'stock' => 50,
                'category_name' => 'Tecnología',
            ],
            [
                'name' => 'Monitor Curvo 27" Full HD 144Hz',
                'description' => 'Monitor gaming con curvatura 1500R y 1ms de tiempo de respuesta.',
                'price' => 219.00,
                'stock' => 20,
                'category_name' => 'Tecnología',
            ],
        ];

        foreach ($products as $item) {
            $category = $categories[$item['category_name']] ?? null;

            Product::firstOrCreate(
                ['name' => $item['name']],
                [
                    'description' => $item['description'],
                    'price'       => $item['price'],
                    'stock'       => $item['stock'],
                    'category_id' => $category ? $category->id : 1,
                ]
            );
        }
    }
}
