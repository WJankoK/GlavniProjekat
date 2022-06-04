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
    public partial class Narudzbine : Form
    {
        List<Narudzbina2> narudzbina2 = new List<Narudzbina2>();
        void PopuniDG()
        {
            dataGridView1.DataSource = narudzbina2;
            for (int i = 0; i < dataGridView1.Rows.Count; i++)
            {
                if (!checkBox1.Checked && dataGridView1.Rows[i].Cells[4].Value.ToString() != "Neisporučeno")
                {
                    CurrencyManager currencyManager1 = (CurrencyManager)BindingContext[dataGridView1.DataSource];
                    currencyManager1.SuspendBinding();
                    dataGridView1.Rows[i].Visible = false;
                    currencyManager1.ResumeBinding();
                }
            }
        }
        public List<string> InfoONarudzbini = new List<string>();
        public Narudzbine()
        {
            InitializeComponent();
        }
        string connectionString = "datasource=127.0.0.1;port=3306;username=root;password=;database=projekat;";
        private void Narudzbine_Load(object sender, EventArgs e)
        {
            MySqlConnection con = new MySqlConnection(connectionString);
            if (con.State == ConnectionState.Closed)
            {
                con.Open();
            }
            string query = "select * from narudzbine";
            MySqlCommand selectcmd = new MySqlCommand(query, con);
            MySqlDataReader dataReader = selectcmd.ExecuteReader();
            List<Narudzbina> narudzbine = new List<Narudzbina>();
            while (dataReader.Read())
            {
                narudzbine.Add(new Narudzbina
                {
                    Id = dataReader.GetInt32("id"),
                    Proizvodi = dataReader.GetString("id_proizvoda"),
                    Kolicine = dataReader.GetString("kolicina"),
                    Korisnik = dataReader.GetString("id_korisnika"),
                    Datum = dataReader.GetString("datum"),
                    UkupnaCena = 0
                });
            }
            dataReader.Close();
            for (int i = 0; i < narudzbine.Count; i++)
            {
                string[] pID = narudzbine[i].Proizvodi.Split(',');
                string[] kol = narudzbine[i].Kolicine.Split(',');
                query = "select email from korisnici where id =" + narudzbine[i].Korisnik + ";";
                selectcmd = new MySqlCommand(query, con);
                InfoONarudzbini.Add("Naručeno: " + narudzbine[i].Datum + "\nKontakt: " + (selectcmd.ExecuteScalar() ?? string.Empty).ToString() + "\nProizvodi:\n");
                string info = "";
                for (int j = 0; j < pID.Length; j++)
                {
                    if (!String.IsNullOrEmpty(pID[j]))
                    {
                        query = "select cena from proizvodi where id =" + (int.Parse(pID[j]) + 1).ToString() + ";";
                        selectcmd = new MySqlCommand(query, con);
                        narudzbine[i].UkupnaCena += int.Parse((selectcmd.ExecuteScalar() ?? string.Empty).ToString()) * int.Parse(kol[j]);
                        query = "select ime from proizvodi where id =" + (int.Parse(pID[j]) + 1).ToString() + ";";
                        selectcmd = new MySqlCommand(query, con);
                        info += kol[j] + " x " + (selectcmd.ExecuteScalar() ?? string.Empty).ToString() + "\n";
                    }
                }
                InfoONarudzbini[i] += info;
                query = "select username from korisnici where id =" + narudzbine[i].Korisnik + ";";
                selectcmd = new MySqlCommand(query, con);
                string korisnikime = (selectcmd.ExecuteScalar() ?? string.Empty).ToString();
                query = "select status from narudzbine where id =" + narudzbine[i].Id + ";";
                selectcmd = new MySqlCommand(query, con);
                string status = (selectcmd.ExecuteScalar() ?? string.Empty).ToString();
                narudzbina2.Add(new Narudzbina2
                {
                    Id = narudzbine[i].Id,
                    Cena = narudzbine[i].UkupnaCena,
                    Korisnik = korisnikime,
                    Datum = narudzbine[i].Datum,
                    Stanje = status
                });
            }
            PopuniDG();
        }

        private void checkBox1_CheckedChanged(object sender, EventArgs e)
        {
            var dg = dataGridView1.Rows;
            for (int i = 0; i < dg.Count; i++)
            {
                if (!checkBox1.Checked)
                {
                    if (dg[i].Cells[4].Value.ToString() != "Neisporučeno")
                    {
                        CurrencyManager currencyManager1 = (CurrencyManager)BindingContext[dataGridView1.DataSource];
                        currencyManager1.SuspendBinding();
                        dg[i].Visible = false;
                        currencyManager1.ResumeBinding();
                    }
                }
                else
                {
                    dg[i].Visible = true;
                }
            }
        }
        private void button1_Click(object sender, EventArgs e)
        {
            richTextBox1.Text = InfoONarudzbini[dataGridView1.CurrentCell.RowIndex];
        }

        private void button2_Click(object sender, EventArgs e)
        {
            MySqlConnection con = new MySqlConnection(connectionString);
            if (con.State == ConnectionState.Closed)
            {
                con.Open();
            }
            var dg = dataGridView1.Rows;
            string stanje = "Isporučeno";
            int rowindex = dataGridView1.CurrentCell.RowIndex;
            if (dg[rowindex].Cells[4].Value.ToString() == "Isporučeno") { stanje = "Neisporučeno"; }
            dg[rowindex].Cells[4].Value = stanje;
            string query = "update narudzbine set status ='" + stanje + "' where id=" + dg[rowindex].Cells[0].Value.ToString() + ";";
            MySqlCommand selectcmd = new MySqlCommand(query, con);
            selectcmd.ExecuteScalar();
            MessageBox.Show("Uspešno ste označili ste narudžbinu kao " + stanje);
            PopuniDG();
        }
    }
}