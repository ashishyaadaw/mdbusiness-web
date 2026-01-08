<?php

namespace Database\Seeders;

use App\Models\EmploymentType;
use App\Models\Occupation;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map specific occupations to each Employment Type
        $employmentMapping = [
            'Private Sector' => [
                'Software Professional',
                'Hardware & Networking',
                'Engineer (Non-IT)',
                'Manager / Executive',
                'Administrative Professional',
                'Marketing / Sales Professional',
                'Consultant',
                'Media / Entertainment',
                'Human Resources',
                'Data Analyst / Scientist',
            ],
            'Government / PSU' => [
                'Civil Services (IAS/IPS/IRS)',
                'Government Clerk / Staff',
                'Public Sector Officer',
                'Doctor (Govt Hospital)',
                'Teacher / Professor (Govt)',
                'Scientist / Researcher',
                'Railway Professional',
                'Banking Professional (PSU)',
            ],
            'Business' => [
                'Business Owner / Entrepreneur',
                'Trader / Merchant',
                'Manufacturer',
                'Real Estate Professional',
                'Distributor / Wholesaler',
            ],
            'Self Employed' => [
                'Freelancer',
                'Chartered Accountant',
                'Lawyer / Legal Professional',
                'Private Tutor',
                'Artist / Creative Professional',
                'Private Practitioner (Medical)',
                'Architect',
                'Content Creator',
            ],
            'Defence' => [
                'Army',
                'Navy',
                'Air Force',
                'Paramilitary Forces',
                'Police',
            ],
            'Not Employed' => [
                'Student',
                'Homemaker',
                'Retired',
                'Job Seeker',
            ],
            'Other' => [
                'Social Worker',
                'Politician',
                'Other',
            ],
        ];

        foreach ($employmentMapping as $type => $occupations) {
            // Retrieve the EmploymentType model (created by your previous seeder)
            $employmentType = EmploymentType::where('name', $type)->first();

            if ($employmentType) {
                foreach ($occupations as $occupationName) {
                    // Create the occupation linked to this employment type
                    // Using firstOrCreate to prevent duplicates
                    Occupation::firstOrCreate([
                        'name' => $occupationName,
                        'employment_type_id' => $employmentType->id,
                    ]);
                }
            }
        }
    }
}
