package PleasantSolutions_GraduatedValue;

import java.util.*;
import java.lang.*;
import java.math.BigDecimal;
import java.math.BigInteger;
import java.io.*;

public class Main {
	public static void main (String[] args) throws java.lang.Exception
	{
		GraduatedValue(50000, 0, true);
		GraduatedValue(5860, 0, true) ;
		GraduatedValue(5860, 2, false);
		
		GraduatedValue(1234567899, 6, false);
	}
	
	public static void GraduatedValue(long value, int decimalPlaces, boolean addDecimalForSingleDigit)
	{
		
		System.out.println(formatNumber(value,decimalPlaces,addDecimalForSingleDigit));
	}
	
	 private static String formatNumber(double number,int decimalPlaces, boolean addDecimalForSingleDigit)
	    {
	        String[] denominations = {"", "K", "M", "B", "T"};
	        int denominationIndex = 0;

	        // If number is greater than 1000, divide the number by 1000 and 
	        // increment the index for the denomination.
	        while(number > 1000.0)
	        {
	            denominationIndex++;
	            number = number / 1000.0;
	        }
	         
	        BigDecimal bigDecimal = new BigDecimal(number);
	        
	        BigDecimal temp = bigDecimal;
	        temp = bigDecimal.setScale(decimalPlaces, BigDecimal.ROUND_HALF_EVEN);
	        
	        if(addDecimalForSingleDigit && temp.toBigInteger().toString().length() < 2)
	        	bigDecimal = bigDecimal.setScale(decimalPlaces+1, BigDecimal.ROUND_HALF_EVEN);
	        else
	        	bigDecimal = temp;

	        // Add the number with the denomination to get the final value.
	        String formattedNumber = bigDecimal + denominations[denominationIndex];
	        return formattedNumber;
	    }
}
