CREATE TABLE DEPARTUREFLIGHTSCHEDULE(
                id integer NOT NULL UNIQUE AUTO_INCREMENT,
                idNum char(5),
                Airline char(30),
                FlightNumber char(5),
                CityState char(90),
                City char(60),
                DateTime char(20),
                Status char(40),
                Gate char(5),
                Time float,
                PRIMARY KEY(id)
                );