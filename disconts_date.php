<?php
    // Пользовательский ввод: указанный год
    //$year = readline("Год: "); // ввод в консоли
	//$year = $_REQUEST['year']; //предполагаемый ввод через форму
	$year = 2021; //на входе принимает произвольный год и выводит в ряд все даты акционных дней для столов вплоть до указанного года (по заданию)
	
	$count_year = 2019; //указанный год (Если за прошедшее число лет было больше...)
	
	//переменная для подсчета каких акционных дней больше
    $count_table = $count_stool = 0;
	
    // Создаем объект для текущей даты - верно!
    $date = new DateTime();
    
    // Установка начальной даты в 2000-01-01
    $date->setDate(2000, 1, 1);
	
	function stool() //если больше для столов
	{
		$date->modify('first friday of this month');

		if ($month % 2 == 0)
		{
			$count_stool += 1;
		}
		else
		{
			$count_table += 1;
			if($date->format('Y') <= $year)//для вывода акционных дат для столов
			{	
				$dis_date[] = $date->format('d-е M. Y');
			}
		}	
        //echo $date->format('d-е M. Y')." "; //в ряд (если нужно в столбик то "/n" )
		
        // Переходим к следующему месяцу
        $date->modify('next month');
	}
	
	function table() //если больше для стульев
	{
		$date->modify('first friday of this month');

		$end_date = $date->format('Y'); //Для определения последнего года, точка отсчета на будущее
		if ($month % 2 == 0)
		{
			$count_table += 1;
			if($date->format('Y') <= $year) //для вывода акционных дат для столов
			{	
				$dis_date[] = $date->format('d-е M. Y');
			}
		}
		else
		{
			$count_stool += 1;
		}	
        //echo $date->format('d-е M. Y')." "; //в ряд (если нужно в столбик то "/n" )
		
        // Переходим к следующему месяцу
        $date->modify('next month');
	}
	
	
	// Заполняем акционными датами до указанного года
    while ($date->format('Y') <= $count_year)
	{
       stool();
    }

	// Заполняем акционными датами, пока счет не сравняется (по заданию)
	while ($count_table != $count_stool)
	{
		$next_year = $count_year + 1;
		if($count_table > $count_stool)
		{
			while($count_year <= $next_year) //цикл для равного счета 
			{
				table();
			}
		}
		else
		{
			while($count_year <= $next_year) //цикл для равного счета 
			{
				stool();
			}
		}
	}
	
	print_r($dis_date) //вывод всех акционных дат для столов (по заданию)
	//если функции не принимаются, то вместо функции, поставить код - при случае сбоев.
	
/*	
<?php
    // Перебираем все месяцы с 2000 года до указанного года пользователя - верно! (Определяем дни для столов)
    while ($date->format('Y') <= $year) {
        // Устанавливаем день в первую пятницу месяца - верно!
        $date->modify('first friday of this month');
		// Выводим дату первой пятницы текущего месяца
		//if ($furniture == table) - проверка акционного дня для столов
        echo $date->format('d-е M. Y')." "; //в ряд (если нужно в столбик то "/n" )
	
        // Переходим к следующему месяцу
        $date->modify('next month');
    }
?>
*/
?>
