package main

import "fmt"

func main(){
	i := 10
	switch i {
	case 1:
		fmt.Println("i is equal to 1")
	case 2, 3, 4:
		fmt.Println("i is equal to 2, 3 or 4")
	case 10:
		fmt.Println("i is equal to 10")
	default:
		fmt.Println("All I know is that i is an integer")
	}

	integer := 6
	switch integer {
		case 4:
		fmt.Println("The integer was <= 4")
		fallthrough
		case 5:
		fmt.Println("The integer was <= 5")
		fallthrough
		case 6:
		fmt.Println("The integer was <= 6")
		fallthrough
		case 7:
		fmt.Println("The integer was <= 7")
		fallthrough
		case 8:
		fmt.Println("The integer was <= 8")
		fallthrough
		default:
		fmt.Println("default case")
	}
}