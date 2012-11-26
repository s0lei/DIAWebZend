CREATE TABLE arrivalflightschedule(
                id INT NOT NULL AUTO_INCREMENT, 
                idNum char(5), 
                Airline char(30),
                FlightNumber char(5),
                CityState char(90),
                Status char(40),
                DateTime char(20),
                Gate char(5), 
			Baggage char(5), 
                Time float,
			PRIMARY KEY(id));
