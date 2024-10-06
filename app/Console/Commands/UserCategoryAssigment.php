<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Icon;
use Illuminate\Console\Command;

class UserCategoryAssigment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign-category {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign category to a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user_id = $this->argument('user_id');

        $this->createExpenseCategory($user_id);

        $this->createIncomeCategory($user_id);

        $this->createAcccountIcon();
    }

    private function createExpenseCategory(string $user_id): void
    {
        $shopping_icon = $this->createIcon(['assets/images/expense-category/shopingcart_shoping_3316.png', 'expense','#ffffff']);

        $this->createCategory(['Shopping', 'enable', $shopping_icon->id,$user_id]);

        $transport_icon = $this->createIcon(['assets/images/expense-category/transport.png', 'expense', '#ffffff']);

        $this->createCategory(['Transportation', 'enable', $transport_icon->id,$user_id]);

        $traveling_icon = $this->createIcon(['assets/images/expense-category/traveling.png', 'expense', '#ffffff']);

        $this->createCategory(['Traveling', 'enable', $traveling_icon->id,$user_id]);

        $wifi_icon = $this->createIcon(['assets/images/expense-category/wifi.svg', 'expense', '#ffffff']);

        $this->createCategory(['Internet', 'enable', $wifi_icon->id,$user_id]);
    }

    private function createIncomeCategory(string $user_id):void
    {
        $salary_icon = $this->createIcon(['assets/images/income-category/salary.png', 'income','#ffffff']);

        $this->createCategory(['Shopping', 'enable', $salary_icon->id,$user_id]);

        $youtube_icon = $this->createIcon(['assets/images/income-category/youtube.png', 'income', '#ffffff']);

        $this->createCategory(['YouTube', 'enable', $youtube_icon->id,$user_id]);
    }

    private function createAcccountIcon()
    {
        $this->createIcon(['assets/images/income-category/salary.png', 'account','#ffffff']);

        $this->createIcon(['assets/images/income-category/youtube.png', 'account', '#ffffff']);
    }

    private function createIcon(array $array)
    {
        return  Icon::create([
            'logo' => $array[0],
            'icon_usage' => $array[1],
            'background_color' => $array[2]
        ]);
    }

    private function createCategory(array $array)
    {
        Category::create([
            'name' => $array[0],
            'status' => $array[1],
            'icon_id' => $array[2],
            'user_id' => $array[3]
        ]);
    }
}
