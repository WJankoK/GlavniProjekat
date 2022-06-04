using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GlavniProjekat
{
    class Narudzbina
    {
        public int Id { get; set; }
        public string Proizvodi { get; set; }
        public string Kolicine { get; set; }
        public string Korisnik { get; set; }
        public string Datum { get; set; }
        public int UkupnaCena { get; set; }
    }
    class Narudzbina2
    {
        public int Id { get; set; }
        public int Cena { get; set; }
        public string Korisnik { get; set; }
        public string Datum { get; set; }
        public string Stanje { get; set; }
    }
}
