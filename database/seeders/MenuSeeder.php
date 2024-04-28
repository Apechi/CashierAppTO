<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data menu
        $menus = [
            //vegan
            ['name' => 'Salad Bayam', 'price' => 25000, 'description' => 'Salad segar dengan campuran bayam organik.', 'type_id' => 1],
            ['name' => 'Tumis Tahu Brokoli', 'price' => 30000, 'description' => 'Tumisan tahu dan brokoli dengan bumbu rempah yang lezat.', 'type_id' => 1],
            ['name' => 'Burger Vegan', 'price' => 35000, 'description' => 'Burger lezat dengan patty vegan dan sayuran segar.', 'type_id' => 1],
            ['name' => 'Pasta Primavera', 'price' => 40000, 'description' => 'Pasta dengan saus tomat dan campuran sayuran segar.', 'type_id' => 1],
            ['name' => 'Nasi Goreng Sayuran', 'price' => 32000, 'description' => 'Nasi goreng dengan campuran sayuran berbagai macam.', 'type_id' => 1],
            //non vegan
            ['name' => 'Ayam Goreng Spesial', 'price' => 45000, 'description' => 'Ayam goreng renyah dengan bumbu spesial.', 'type_id' => 2],
            ['name' => 'Bistik Sapi', 'price' => 60000, 'description' => 'Potongan daging sapi panggang dengan saus bumbu kaya.', 'type_id' => 2],
            ['name' => 'Ikan Bakar Rica-Rica', 'price' => 55000, 'description' => 'Ikan bakar dengan bumbu pedas khas Rica-Rica.', 'type_id' => 2],
            ['name' => 'Babi Panggang BBQ', 'price' => 70000, 'description' => 'Potongan babi panggang dengan saus BBQ yang karamel.', 'type_id' => 2],
            ['name' => 'Udang Goreng Tepung', 'price' => 50000, 'description' => 'Udang goreng renyah dengan balutan tepung gurih.', 'type_id' => 2],

            //kopi

            ['name' => 'Espresso', 'price' => 15000, 'description' => 'Minuman kopi hitam klasik.', 'type_id' => 3],
            ['name' => 'Cappuccino', 'price' => 20000, 'description' => 'Espresso dengan tambahan susu dan busa susu.', 'type_id' => 3],
            ['name' => 'Latte', 'price' => 25000, 'description' => 'Espresso dengan susu steamed.', 'type_id' => 3],
            ['name' => 'Americano', 'price' => 18000, 'description' => 'Espresso dengan tambahan air panas.', 'type_id' => 3],
            ['name' => 'Macchiato', 'price' => 22000, 'description' => 'Espresso dengan tambahan sejumlah kecil susu.', 'type_id' => 3],

            //teh 

            ['name' => 'Teh Hijau', 'price' => 10000, 'description' => 'Teh hijau segar yang kaya akan antioksidan.', 'type_id' => 4],
            ['name' => 'Teh Hitam', 'price' => 8000, 'description' => 'Teh hitam dengan rasa klasik yang kuat.', 'type_id' => 4],
            ['name' => 'Teh Tarik', 'price' => 12000, 'description' => 'Teh manis dengan aroma wangi susu.', 'type_id' => 4],
            ['name' => 'Teh Chamomile', 'price' => 15000, 'description' => 'Teh herbal dengan bunga chamomile.', 'type_id' => 4],
            ['name' => 'Teh Matcha Latte', 'price' => 20000, 'description' => 'Teh matcha dengan susu steamed.', 'type_id' => 4],

            //soda

            ['name' => 'Soda Jeruk', 'price' => 12000, 'description' => 'Minuman soda segar dengan rasa jeruk.', 'type_id' => 5],
            ['name' => 'Soda Lemon', 'price' => 12000, 'description' => 'Minuman soda segar dengan perasan lemon.', 'type_id' => 5],
            ['name' => 'Soda Anggur', 'price' => 15000, 'description' => 'Minuman soda segar dengan rasa anggur.', 'type_id' => 5],
            ['name' => 'Soda Cola', 'price' => 10000, 'description' => 'Minuman soda klasik dengan rasa cola.', 'type_id' => 5],
            ['name' => 'Soda Blueberry', 'price' => 15000, 'description' => 'Minuman soda segar dengan rasa blueberry.', 'type_id' => 5],

            //jus buah

            ['name' => 'Jus Jeruk', 'price' => 18000, 'description' => 'Jus segar dari perasan buah jeruk.', 'type_id' => 6],
            ['name' => 'Jus Apel', 'price' => 20000, 'description' => 'Jus segar dari buah apel.', 'type_id' => 6],
            ['name' => 'Jus Strawberry', 'price' => 25000, 'description' => 'Jus segar dari buah strawberry.', 'type_id' => 6],
            ['name' => 'Jus Anggur', 'price' => 22000, 'description' => 'Jus segar dari buah anggur.', 'type_id' => 6],
            ['name' => 'Jus Kiwi', 'price' => 23000, 'description' => 'Jus segar dari buah kiwi.', 'type_id' => 6],

            //es krim


            ['name' => 'Eskrim Vanilla', 'price' => 15000, 'description' => 'Eskrim lezat dengan rasa vanilla.', 'type_id' => 7],
            ['name' => 'Eskrim Coklat', 'price' => 15000, 'description' => 'Eskrim dengan rasa coklat yang kaya.', 'type_id' => 7],
            ['name' => 'Eskrim Strawberry', 'price' => 15000, 'description' => 'Eskrim dengan rasa strawberry yang segar.', 'type_id' => 7],
            ['name' => 'Eskrim Pistachio', 'price' => 18000, 'description' => 'Eskrim dengan rasa pistachio yang unik.', 'type_id' => 7],
            ['name' => 'Eskrim Cookie Dough', 'price' => 20000, 'description' => 'Eskrim dengan potongan cookie dough di dalamnya.', 'type_id' => 7],


            //brownis

            ['name' => 'Brownies Klasik', 'price' => 25000, 'description' => 'Brownies dengan rasa klasik yang lezat.', 'type_id' => 8],
            ['name' => 'Brownies Kacang', 'price' => 28000, 'description' => 'Brownies dengan tambahan kacang untuk rasa renyah.', 'type_id' => 8],
            ['name' => 'Brownies Double Chocolate', 'price' => 30000, 'description' => 'Brownies dengan dua lapis coklat yang melimpah.', 'type_id' => 8],
            ['name' => 'Brownies Mint', 'price' => 27000, 'description' => 'Brownies dengan sentuhan rasa mint yang segar.', 'type_id' => 8],
            ['name' => 'Brownies Salted Caramel', 'price' => 32000, 'description' => 'Brownies dengan topping salted caramel yang manis.', 'type_id' => 8],


            //donat
            ['name' => 'Donat Glazur', 'price' => 5000, 'description' => 'Donat lembut dengan glazur gula.', 'type_id' => 9],
            ['name' => 'Donat Coklat', 'price' => 6000, 'description' => 'Donat lembut dengan taburan coklat.', 'type_id' => 9],
            ['name' => 'Donat Strawberry', 'price' => 6000, 'description' => 'Donat lembut dengan taburan strawberry.', 'type_id' => 9],
            ['name' => 'Donat Matcha', 'price' => 7000, 'description' => 'Donat lembut dengan taburan bubuk matcha.', 'type_id' => 9],
            ['name' => 'Donat Red Velvet', 'price' => 8000, 'description' => 'Donat lembut dengan topping cream cheese red velvet.', 'type_id' => 9],

            //cupcake

            ['name' => 'Cupcake Vanilla', 'price' => 7000, 'description' => 'Cupcake lembut dengan rasa vanilla yang manis.', 'type_id' => 10],
            ['name' => 'Cupcake Coklat', 'price' => 8000, 'description' => 'Cupcake dengan rasa coklat yang kaya.', 'type_id' => 10],
            ['name' => 'Cupcake Red Velvet', 'price' => 9000, 'description' => 'Cupcake dengan rasa red velvet yang lembut.', 'type_id' => 10],
            ['name' => 'Cupcake Strawberry', 'price' => 8000, 'description' => 'Cupcake dengan rasa strawberry yang segar.', 'type_id' => 10],
            ['name' => 'Cupcake Lemon', 'price' => 7500, 'description' => 'Cupcake dengan aroma dan rasa lemon yang menyegarkan.', 'type_id' => 10],

            //roti

            ['name' => 'Roti Tawar', 'price' => 5000, 'description' => 'Roti segar dengan tekstur lembut.', 'type_id' => 11],
            ['name' => 'Roti Gandum', 'price' => 6000, 'description' => 'Roti gandum segar dengan rasa kaya dan gizi.', 'type_id' => 11],
            ['name' => 'Roti Manis', 'price' => 7000, 'description' => 'Roti lembut dengan taburan gula.', 'type_id' => 11],
        ];

        foreach ($menus as $menu) {
            Menu::create([
                'name' => $menu['name'],
                'price' => $menu['price'],
                'description' => $menu['description'],
                'type_id' => $menu['type_id'],
            ]);
        }
    }
}
