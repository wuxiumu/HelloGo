package main

func main() {
	
	var array [100]int   
	slice := array[0:99] 

	slice[98] = 'a'	     
	slice[99] = 'a'     
}