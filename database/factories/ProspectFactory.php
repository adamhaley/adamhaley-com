<?php

namespace Database\Factories;

use App\Enums\ProspectStatus;
use App\Models\Prospect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prospect>
 */
class ProspectFactory extends Factory
{
    protected $model = Prospect::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source' => 'field_report',
            'source_external_id' => null,
            'name' => $this->faker->name(),
            'company' => $this->faker->company(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'website' => $this->faker->url(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'summary' => $this->faker->sentence(),
            'status' => ProspectStatus::New,
            'raw_payload' => null,
        ];
    }
}
