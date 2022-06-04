using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySql.Data.MySqlClient;

namespace GlavniProjekat
{

    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
        }

        private void button1_Click(object sender, EventArgs e)
        {
            DodajProizvod f = new DodajProizvod();
            f.Show();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Narudzbine f = new Narudzbine();
            f.Show();
        }
    }
}
