<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->name,
            'address'=> $this->faker->address,
            'phone'=> $this->faker->phoneNumber,
            'birthday'=> $this->faker->date,
        ];
    }
}
