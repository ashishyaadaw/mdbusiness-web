<?php

namespace Database\Seeders;

use App\Models\Caste;
use App\Models\Religion;
use Illuminate\Database\Seeder;

class CasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Define the main Data Array
        $data = [
            'Hindu' => [
                '24 Manai Telugu Chettiar', '96 Kuli Maratha', 'Aaru Nattu Vellala', 'Achirapakkam Chettiar',
                'Ad Dharmi', 'Adi Andhra', 'Adi Dravidar', 'Adi Karnataka', 'Agamudayar / Arcot / Thuluva Vellala',
                'Agaram Vellan Chettiar', 'Agarwal', 'Agnikula Kshatriya', 'Agrahari', 'Agri', 'Ahirwar', 'Ahom',
                'Ambalavasi', 'Anjana (Chowdary) Patel', 'Aramari / Gabit', 'Arekatica', 'Arora', 'Arunthathiyar',
                'Arya Vysya', 'Asathi', 'Ayira Vysya', 'Ayodhyavasi', 'Ayyaraka', 'Badaga', 'Baidya', 'Bairwa',
                'Baishnab', 'Baishya', 'Balai', 'Balija', 'Balija Naidu', 'Balija Reddy', 'Banayat Oriya', 'Banik',
                'Baniya', 'Baniya - Bania', 'Baniya - Kumuti', 'Banjara', 'Baori', 'Barai', 'Bargi', 'Bari', 'Baria',
                'Barnwal', 'Barujibi', 'Bavaria', 'Bazigar', 'Beldar', 'Beri Chettiar', 'Besta', 'Bhand', 'Bhandari',
                'Bhar', 'Bharbhunja', 'Bhatia', 'Bhatraju', 'Bhavasar Kshatriya', 'Bhil', 'Bhoi', 'Bhovi', 'Bhoyar',
                'Bhulia / Meher', 'Billava', 'Bind', 'Bishnoi / Vishnoi', 'Bondili', 'Boyar', 'Brajastha Maithil',
                'Brahmakshtriya', 'Brahmbatt', 'Brahmin - Anavil', 'Brahmin - Anaviln Desai', 'Brahmin - Audichya',
                'Brahmin - Bagra', 'Brahmin - Baidhiki / Vaidhiki', 'Brahmin - Baragaon', 'Brahmin - Bardai',
                'Brahmin - Barendra', 'Brahmin - Bhargav', 'Brahmin - Bhatt', 'Brahmin - Bhojak', 'Brahmin - Bhumihar',
                'Brahmin - Chaubisa', 'Brahmin - Dadhich', 'Brahmin - Daivadnya', 'Brahmin - Dakaut', 'Brahmin - Danua',
                'Brahmin - Deshastha', 'Brahmin - Dhiman', 'Brahmin - Dravida', 'Brahmin - Embrandiri', 'Brahmin - Garhwali',
                'Brahmin - Gaur', 'Brahmin - Goswami / Gosavi', 'Brahmin - Gujar Gaur', 'Brahmin - Gurukkal',
                'Brahmin - Halua', 'Brahmin - Havyaka', 'Brahmin - Hoysala', 'Brahmin - Iyengar', 'Brahmin - Iyer',
                'Brahmin - Jangid', 'Brahmin - Jhadua', 'Brahmin - Jyotish', 'Brahmin - Kanyakubj', 'Brahmin - Karhade',
                'Brahmin - Khadayata', 'Brahmin - Khandelwal', 'Brahmin - Khedaval', 'Brahmin - Kokanastha',
                'Brahmin - Kota', 'Brahmin - Koteshwara / Kota (Madhva)', 'Brahmin - Kulin', 'Brahmin - Kumaoni',
                'Brahmin - Madhwa', 'Brahmin - Maithil', 'Brahmin - Mevada', 'Brahmin - Modh', 'Brahmin - Mohyal',
                'Brahmin - Nagar', 'Brahmin - Namboodiri', 'Brahmin - Narmadiya', 'Brahmin - Niyogi', 'Brahmin - Paliwal',
                'Brahmin - Panda', 'Brahmin - Pandit', 'Brahmin - Panicker', 'Brahmin - Pareek', 'Brahmin - Pushkarna',
                'Brahmin - Rajgor', 'Brahmin - Rarhi', 'Brahmin - Rarhi / Radhi', 'Brahmin - Rigvedi', 'Brahmin - Rudraj',
                'Brahmin - Sakaldwipi', 'Brahmin - Sanadya', 'Brahmin - Sanketi', 'Brahmin - Saraswat', 'Brahmin - Sarua',
                'Brahmin - Saryuparin', 'Brahmin - Shivalli (Madhva)', 'Brahmin - Shivhalli', 'Brahmin - Shri Gaud',
                'Brahmin - Shri Mali', 'Brahmin - Shrimali', 'Brahmin - Shukla Yajurvedi', 'Brahmin - Sikhwal',
                'Brahmin - Smartha', 'Brahmin - Sri Vaishnava', 'Brahmin - Stanika', 'Brahmin - Tapodhan',
                'Brahmin - Tyagi', 'Brahmin - Vaidiki', 'Brahmin - Vaikhanasa', 'Brahmin - Valam', 'Brahmin - Velanadu',
                'Brahmin - Vyas', 'Brahmin - Zalora', 'Bunt (Shetty)', 'CKP', 'Chakkala Nair', 'Chalawadi and Holeya',
                'Chambhar', 'Chandravanshi Kahar', 'Charan', 'Chasa', 'Chattada Sri Vaishnava', 'Chaturth', 'Chaudary',
                'Chaurasia', 'Chennadasar', 'Cherakula Vellalar', 'Chero', 'Chettiar', 'Chhetri', 'Chippolu (Mera)',
                'Choudhary', 'Coorgi', 'Dasapalanjika / Kannada Saineegar', 'Deshmukh', 'Desikar', 'Desikar Thanjavur',
                'Devadiga', 'Devandra Kula Vellalar', 'Devang Koshthi', 'Devanga', 'Devanga Chettiar',
                'Devar / Thevar / Mukkulathor', 'Devrukhe Brahmin', 'Dhakad', 'Dhanak', 'Dhangar', 'Dhanka', 'Dhanuk',
                'Dheevara', 'Dhiman', 'Dhoba', 'Dhor / Kakkayya', 'Dommala', 'Dosar / Dusra', 'Dumal', 'Dusadh (Paswan)',
                'Ediga', 'Ediga / Goud (Balija)', 'Elur Chetty', 'Ezhava', 'Ezhava Panicker', 'Ezhava Thandan',
                'Ezhuthachan', 'Gabit', 'Gahoi', 'Gajula / Kavarai', 'Ganda', 'Gandha Vanika', 'Gandharb', 'Gandla',
                'Gandla / Ganiga', 'Ganiga', 'Garhwali', 'Garo / Garoda', 'Gatti', 'Gavandi', 'Gavara', 'Gavaria',
                'Gawali', 'Ghisadi', 'Ghumar', 'Goala', 'Goan', 'Gomantak', 'Gond', 'Gondhali', 'Gopal / Gopala', 'Goud',
                'Gounder', 'Gounder - Kongu Vellala Gounder', 'Gounder - Nattu Gounder', 'Gounder - Others',
                'Gounder - Urali Gounder', 'Gounder - Vanniya Kula Kshatriyar', 'Gounder - Vettuva Gounder', 'Gowda',
                'Gowda - Kuruba Gowda', 'Gramani', 'Gudia', 'Gujjar', 'Gulahre', 'Gupta', 'Guptan', 'Gurav', 'Gurjar',
                'Haihaivanshi', 'Halba Koshti', 'Heggade', 'Helava', 'Holar', 'Hugar (Jeer)', 'Illaththu Pillai',
                'Intercaste', 'Irani', 'Isai Vellalar', 'Jaalari', 'Jaiswal', 'Jandra', 'Jangam', 'Jangra - Brahmin',
                'Jat', 'Jatav', 'Jetty / Malla', 'Jhadav', 'Jijhotia Brahmin', 'Jingar', 'Jogi (Nath)', 'Julaha',
                'Kachara', 'Kadava Patel', 'Kadia', 'Kahar', 'Kaibarta', 'Kaikaala', 'Kalal', 'Kalanji', 'Kalar',
                'Kalbelia', 'Kalita', 'Kalinga', 'Kalinga Vysya', 'Kalwar', 'Kamboj', 'Kamma', 'Kamma Naidu',
                'Kanakkan Padanna', 'Kandara', 'Kandera', 'Kanjar', 'Kansari', 'Kansyakaar', 'Kanykubj Bania', 'Kapu',
                'Kapu Naidu', 'Kapu Reddy', 'Karakala Bhakthula', 'Karana', 'Karkathar', 'Karmakar', 'Karni Bhakthula',
                'Karuneegar', 'Kasar', 'Kasaundhan', 'Kasera', 'Kashyap', 'Kasukara', 'Katiya', 'Kavara',
                'Kavuthiyya / Ezhavathy', 'Kayastha', 'Kayastha (Bengali)', 'Kerala Mudali', 'Keshri (Kesarwani)',
                'Khandayat', 'Khandelwal', 'Kharwa', 'Kharwar', 'Khatik', 'Khatri', 'Kirar', 'Kodava', 'Kodikal Pillai',
                'Kokanastha Maratha', 'Kokna', 'Koli', 'Koli Mahadev', 'Koli Patel', 'Komti / Arya Vaishya',
                'Kongu Chettiar', 'Kongu Nadar', 'Kongu Vellala Gounder', 'Konkani', 'Korama', 'Kori', 'Kori / Koli',
                'Kosthi', 'Krishnavaka', 'Kshatriya', 'Kshatriya Kurmi', 'Kshatriya Raju', 'Kudumbi', 'Kulal', 'Kulalar',
                'Kulita', 'Kumaoni Rajput', 'Kumawat', 'Kumbhakar', 'Kumbhar', 'Kumhar', 'Kummari', 'Kunbi',
                'Kunbi Lonari', 'Kunbi Maratha', 'Kunbi Tirale', 'Kuravan', 'Kurmi', 'Kurmi / Kurmi Kshatriya', 'Kurni',
                'Kuruba', 'Kuruhina Shetty', 'Kuruhini Chetty', 'Kurumbar', 'Kuruva', 'Kushwaha (Koiri)', 'Kutchi',
                'Lad', 'Lakhara / Lakhera / Laxkar', 'Lambadi', 'Laxminarayan Gola', 'Leva Patel', 'Leva Patil',
                'Linga Balija', 'Lingayath', 'Lodhi Rajput', 'Lohana', 'Lohar', 'Loniya', 'Lubana',
                'Madhesiya / Kanu / Halwai', 'Madiga', 'Madivala / Dhobi', 'Mahajan', 'Mahar', 'Mahendra', 'Maheshwari',
                'Maheshwari / Meshri', 'Mahishya', 'Mahor', 'Mahuri', 'Mair Rajput Swarnkar', 'Majabi', 'Mala', 'Mali',
                'Mallah', 'Malviya Brahmin', 'Malwani', 'Mangalorean', 'Manipuri', 'Manjapudur Chettiar', 'Mannadiyar',
                'Mannan / Velan / Vannan', 'Mapila', 'Maratha', 'Maratha Kshatriya', 'Maruthuvar', 'Matang', 'Mathur',
                'Mathur Vaishya', 'Matia Patel', 'Maurya / Shakya', 'Meena', 'Meenavar', 'Meghwal', 'Mehar', 'Mehra',
                'Meru Darji', 'Mochi', 'Modak', 'Modh Ghanchi', 'Modi', 'Modikarlu', 'Mogaveera', 'Mudaliyar', 'Mudiraj',
                'Munnuru Kapu', 'Musahar', 'Musukama', 'Muthuraja / Mutharaiyar', 'Naagavamsam', 'Nabit', 'Nadar',
                'Nagaralu', 'Nai / Nayi Brahmin', 'Naicker', 'Naicker - Others', 'Naicker - Vanniya Kula Kshatriyar',
                'Naidu', 'Naik', 'Nair', 'Namasudra / Namassej', 'Nambiar', 'Namdarlu', 'Nanjil Mudali',
                'Nanjil Nattu Vellalar', 'Nanjil Vellalar', 'Nanjil pillai', 'Nankudi Vellalar', 'Napit', 'Nat',
                'Nattu Gounder', 'Nattukottai Chettiar', 'Nayaka', 'Neeli', 'Neeli Saali', 'Nema', 'Nepali', 'Nessi',
                'Nhavi', 'Niari', 'Odan', 'Ontari', 'Oraon', 'Oswal', 'Otari', 'Other Brahmins', 'Othuvaar', 'Padmasali',
                'Padmashali', 'Padmavati Porwal', 'Pagadala', 'Pal', 'Pallan / Devandra Kula Vellalar', 'Panan',
                'Panchal', 'Pandaram', 'Pandiya Vellalar', 'Panicker', 'Pannirandam Chettiar', 'Paravan / Bharatar',
                'Parit', 'Parkavakulam / Udayar', 'Parsi', 'Partraj', 'Parvatha Rajakulam', 'Pasi', 'Paswan / Dusadh',
                'Patel', 'Pathare Prabhu', 'Patil', 'Patnaick / Sistakaranam', 'Patra', 'Pattinavar', 'Pattusali',
                'Patwa', 'Perika', 'Perika / Puragiri Kshatriya', 'Pillai', 'Poddar', 'Poosala', 'Porwal',
                'Porwal / Porwar', 'Poundra', 'Prajapati', 'Pulaya / Cheruman', 'Rabari', 'Radhi / Niari', 'Raigar',
                'Rajaka / Vannar', 'Rajastani', 'Rajbhar', 'Rajbonshi', 'Rajpurohit', 'Rajput', 'Raju / Kshatriya Raju',
                'Ramoshi', 'Ramanandi', 'Ramdasia', 'Ramgariah', 'Rastogi', 'Rathi', 'Rauniar', 'Ravana Rajput',
                'Ravidasia', 'Rawat', 'Reddy', 'Relli', 'Rohit / Chamar', 'Ror', 'SC', 'SKP', 'ST', 'Sadgope',
                'Sadhu Chetty', 'Sagara (Uppara)', 'Saha', 'Sahariya', 'Sahu', 'Saini', 'Saiva Pillai Thanjavur',
                'Saiva Pillai Tirunelveli', 'Saiva Vellan Chettiar', 'Saliya', 'Saliyar', 'Salvi', 'Samagar', 'Sambava',
                'Sansi', 'Sargara', 'Sathwara', 'Satnami', 'Savji', 'Senai Thalaivar', 'Senguntha Mudaliyar',
                'Sengunthar / Kaikolar', 'Settibalija', 'Setty Balija', 'Shah', 'Shaw / Sahu / Teli', 'Shettigar',
                'Shilpkar', 'Shimpi / Namdev', 'Sindhi', 'Sindhi - Amil', 'Sindhi - Baibhand', 'Sindhi - Bhanusali',
                'Sindhi - Bhatia', 'Sindhi - Chhapru', 'Sindhi - Dadu', 'Sindhi - Hyderabadi', 'Sindhi - Larai',
                'Sindhi - Larkana', 'Sindhi - Lohana', 'Sindhi - Rohiri', 'Sindhi - Sahiti', 'Sindhi - Sakkhar',
                'Sindhi - Sehwani', 'Sindhi - Shikarpuri', 'Sindhi - Thatai', 'Sirvi / Janwa', 'Sonar', 'Sondhia',
                'Soni', 'Sonkar', 'Sourashtra', 'Sozhia Chetty', 'Sozhiya Vellalar', 'Srisayana', 'Sugali (Naika)',
                'Sunari', 'Sundhi', 'Surya Balija', 'Suthar', 'Swakula Saali', 'Swakula Sali', 'Swarnakar', 'Tamboli',
                'Tammali', 'Tanti', 'Tantubai', 'Telaga', 'Teli', 'Telugupatti', 'Thakkar', 'Thakore', 'Thakur',
                'Thandan', 'Tharakan', 'Thigala', 'Thiyya', 'Thiyya Thandan', 'Thogata Veera Kshatriya',
                'Thogata Veerakshathriya', 'Thondai Mandala Vellalar', 'Thota', 'Tili', 'Tiyar / Tiar', 'Togata',
                'Tonk Kshatriya', 'Turupu Kapu', 'Ummar / Umre / Bagaria', 'Urali Gounder', 'Urs', 'Vaishnav Vania',
                'Vaishnava', 'Vaishya', 'Vaishya Vani', 'Valar', 'Valluvan', 'Valmiki', 'Valsad', 'Vani',
                'Vani / Vaishya', 'Vania', 'Vanika Vyshya', 'Vaniya', 'Vaniya Chettiar', 'Vanjara', 'Vankar', 'Vannar',
                'Vannia Kula Kshatriyar', 'Vanyakulakshatriya', 'Variar', 'Varshney', 'Varshney (Barahseni)',
                'Veera Saivam', 'Veerakodi Vellala', 'Velaan', 'Velama', 'Vellala Pillai', 'Vellalar',
                'Vellan Chettiars', 'Veluthedathu Nair', 'Vettuva Gounder', 'Vettuvan', 'Vijayvargia',
                'Vilakithala Nair', 'Vishwakarma', 'Viswabrahmin', 'Vokkaliga', 'Vysya', 'Yadav', 'Yadava Naidu',
                'Yellapu',
            ],
            'Christian' => [
                'Adventist', 'Anglican / Episcopal', 'Anglo-Indian', 'Apostolic', 'Assembly of God (AG)',
                'Baptist', // Fixed spelling from Baptis
                'Born Again', 'Brethren', 'Calvinist', 'Chaldean Syrian (Assyrian)', 'Christian - Others',
                'Church of Christ', 'Church of God', 'Church of North India', 'Church of South India', 'Congregational',
                'Evangelist', 'Jacobite', "Jehovah's Witnesses", 'Knanaya', 'Knanaya Catholic', 'Knanaya Jacobite',
                'Latin Catholic', 'Latter day saints', 'Lutheran', 'Malabar Independent Syrian Church',
                'Malankara Catholic', 'Marthoma', 'Melkite', 'Mennonite', 'Methodist', 'Moravian', 'Orthodox',
                'Pentecost', 'Presbyterian', 'Protestant', 'Reformed Baptist', 'Reformed Presbyterian',
                'Roman Catholic', 'Seventh-day Adventist', 'St. Thomas Evangelical', 'Syrian Catholic',
                'Syrian Jacobite', 'Syrian Orthodox', 'Syrian Malabar',
            ],
            'Muslim - Shia' => [
                "Don't wish to specify", 'Muslim - Ansari', 'Muslim - Arain', 'Muslim - Awan', 'Muslim - Bohra',
                'Muslim - Dekkani', 'Muslim - Dudekula', 'Muslim - Hanafi', 'Muslim - Jat', 'Muslim - Khoja',
                'Muslim - Lebbai', 'Muslim - Malik', 'Muslim - Mapila', 'Muslim - Maraicar', 'Muslim - Memon',
                'Muslim - Mughal', 'Muslim - Others', 'Muslim - Pathan', 'Muslim - Qureshi', 'Muslim - Rajput',
                'Muslim - Rowther', 'Muslim - Shafi', 'Muslim - Sheikh', 'Muslim - Siddiqui', 'Muslim - Syed',
                'Muslim - Unspecified', 'Others',
            ],
            'Muslim - Sunni' => [
                "Don't wish to specify", 'Muslim - Ansari', 'Muslim - Arain', 'Muslim - Awan', 'Muslim - Bohra',
                'Muslim - Dekkani', 'Muslim - Dudekula', 'Muslim - Hanafi', 'Muslim - Jat', 'Muslim - Khoja',
                'Muslim - Lebbai', 'Muslim - Malik', 'Muslim - Mapila', 'Muslim - Maraicar', 'Muslim - Memon',
                'Muslim - Mughal', 'Muslim - Others', 'Muslim - Pathan', 'Muslim - Qureshi', 'Muslim - Rajput',
                'Muslim - Rowther', 'Muslim - Shafi', 'Muslim - Sheikh', 'Muslim - Siddiqui', 'Muslim - Syed',
                'Muslim - Unspecified', 'Others',
            ],
            'Muslim - Others' => [
                "Don't wish to specify", 'Muslim - Ansari', 'Muslim - Arain', 'Muslim - Awan', 'Muslim - Bohra',
                'Muslim - Dekkani', 'Muslim - Dudekula', 'Muslim - Hanafi', 'Muslim - Jat', 'Muslim - Khoja',
                'Muslim - Lebbai', 'Muslim - Malik', 'Muslim - Mapila', 'Muslim - Maraicar', 'Muslim - Memon',
                'Muslim - Mughal', 'Muslim - Others', 'Muslim - Pathan', 'Muslim - Qureshi', 'Muslim - Rajput',
                'Muslim - Rowther', 'Muslim - Shafi', 'Muslim - Sheikh', 'Muslim - Siddiqui', 'Muslim - Syed',
                'Muslim - Unspecified', 'Others',
            ],
            'Sikh' => [
                "Don't wish to specify", 'Others', 'Sikh - Ahluwalia', 'Sikh - Arora', 'Sikh - Bhatia', 'Sikh - Bhatra',
                'Sikh - Ghumar', 'Sikh - Intercaste', 'Sikh - Jat', 'Sikh - Kamboj', 'Sikh - Khatri', 'Sikh - Kshatriya',
                'Sikh - Lubana', 'Sikh - Majabi', 'Sikh - Nai', 'Sikh - Others', 'Sikh - Rai', 'Sikh - Rajput',
                'Sikh - Ramdasia', 'Sikh - Ramgharia', 'Sikh - Ravidasia', 'Sikh - Saini', 'Sikh - Tonk Kshatriya',
                'Sikh - Unspecified',
            ],
            'Jain - Digambar' => [
                "Don't wish to specify", 'Jain - Agarwal', 'Jain - Asati', 'Jain - Ayodhyavasi', 'Jain - Bagherwal',
                'Jain - Bania', 'Jain - Barhiya', 'Jain - Charanagare', 'Jain - Chaturtha', 'Jain - Dhakada',
                'Jain - Gahoi / Grihapati', 'Jain - Golalare / Kharaua', 'Jain - Golapurva', 'Jain - Golsinghare',
                'Jain - Harada', 'Jain - Humad / Humbad', 'Jain - Intercaste', 'Jain - Jaiswal', 'Jain - Kambhoja',
                'Jain - Kasar', 'Jain - Kathanere', 'Jain - Khandelwal', 'Jain - Kharaua', 'Jain - Kutchi',
                'Jain - KVO', 'Jain - Lamechu', 'Jain - Nema', 'Jain - Oswal', 'Jain - Others', 'Jain - Padmavati Porwal',
                'Jain - Palliwal', 'Jain - Panchama', 'Jain - Parmar', 'Jain - Parwar / Paravara', 'Jain - Porwad / Porwal',
                'Jain - Porwal', 'Jain - Saitwal', 'Jain - Samanar / Nayinar', 'Jain - Samiya', 'Jain - Sarak',
                'Jain - Shrimal', 'Jain - Unspecified', 'Jain - Upadhyaya', 'Jain - Vaishya', 'Jain - Veerwal',
            ],
            'Jain - Shwetambar' => [
                "Don't wish to specify", 'Jain - Agarwal', 'Jain - Asati', 'Jain - Ayodhyavasi', 'Jain - Bagherwal',
                'Jain - Bania', 'Jain - Barhiya', 'Jain - Charanagare', 'Jain - Chaturtha', 'Jain - Dhakada',
                'Jain - Gahoi / Grihapati', 'Jain - Golalare / Kharaua', 'Jain - Golapurva', 'Jain - Golsinghare',
                'Jain - Harada', 'Jain - Humad / Humbad', 'Jain - Intercaste', 'Jain - Jaiswal', 'Jain - Kambhoja',
                'Jain - Kasar', 'Jain - Kathanere', 'Jain - Khandelwal', 'Jain - Kharaua', 'Jain - Kutchi',
                'Jain - KVO', 'Jain - Lamechu', 'Jain - Nema', 'Jain - Oswal', 'Jain - Others', 'Jain - Padmavati Porwal',
                'Jain - Palliwal', 'Jain - Panchama', 'Jain - Parmar', 'Jain - Parwar / Paravara', 'Jain - Porwad / Porwal',
                'Jain - Porwal', 'Jain - Saitwal', 'Jain - Samanar / Nayinar', 'Jain - Samiya', 'Jain - Sarak',
                'Jain - Shrimal', 'Jain - Unspecified', 'Jain - Upadhyaya', 'Jain - Vaishya', 'Jain - Veerwal',
            ],
            'Jain - Others' => [
                "Don't wish to specify", 'Jain - Agarwal', 'Jain - Asati', 'Jain - Ayodhyavasi', 'Jain - Bagherwal',
                'Jain - Bania', 'Jain - Barhiya', 'Jain - Charanagare', 'Jain - Chaturtha', 'Jain - Dhakada',
                'Jain - Gahoi / Grihapati', 'Jain - Golalare / Kharaua', 'Jain - Golapurva', 'Jain - Golsinghare',
                'Jain - Harada', 'Jain - Humad / Humbad', 'Jain - Intercaste', 'Jain - Jaiswal', 'Jain - Kambhoja',
                'Jain - Kasar', 'Jain - Kathanere', 'Jain - Khandelwal', 'Jain - Kharaua', 'Jain - Kutchi',
                'Jain - KVO', 'Jain - Lamechu', 'Jain - Nema', 'Jain - Oswal', 'Jain - Others', 'Jain - Padmavati Porwal',
                'Jain - Palliwal', 'Jain - Panchama', 'Jain - Parmar', 'Jain - Parwar / Paravara', 'Jain - Porwad / Porwal',
                'Jain - Porwal', 'Jain - Saitwal', 'Jain - Samanar / Nayinar', 'Jain - Samiya', 'Jain - Sarak',
                'Jain - Shrimal', 'Jain - Unspecified', 'Jain - Upadhyaya', 'Jain - Vaishya', 'Jain - Veerwal',
            ],
            'Parsi' => [
                "Don't wish to specify", 'Intercaste', 'Irani', 'Parsi', 'Others',
            ],
            'Buddhist' => [
                "Don't wish to specify", 'Neo Buddhist', 'Tibetan Buddhist', 'Others',
            ],
            'Jewish' => [
                // Fixed: removed incorrect Buddhist entries
                "Don't wish to specify", 'Bene Israel', 'Cochin', 'Baghdadi', 'Knana', 'Bnei Menashe', 'Others',
            ],
            'Inter - Religion' => [
                // This is populated dynamically below
            ],
        ];

        // 2. Dynamically Generate Inter - Religion Permutations
        // We generate "Hindu - Christian" AND "Christian - Hindu" as you requested.
        // Creating specific Caste - Caste permutations (e.g. "Hindu - Muslim Ansari") for all thousands of castes
        // is too large for the database, so we generate Religion-level combinations here.

        $religionKeys = array_keys($data);
        $interReligionCastes = [];

        // Add your specific requested example explicitly if needed
        $interReligionCastes[] = 'Hindu - Muslim Ansari';
        $interReligionCastes[] = 'Muslim Ansari - Hindu';

        // Generate general Religion - Religion combinations
        foreach ($religionKeys as $r1) {
            if ($r1 === 'Inter - Religion') {
                continue;
            } // Skip self

            foreach ($religionKeys as $r2) {
                if ($r2 === 'Inter - Religion') {
                    continue;
                } // Skip self
                if ($r1 === $r2) {
                    continue;
                } // Skip same religion (e.g. Hindu - Hindu)

                // This creates "Hindu - Muslim", "Muslim - Hindu", "Christian - Hindu", etc.
                // Since we are doing a nested loop, both A-B and B-A will be generated.
                $interReligionCastes[] = "$r1 - $r2";
            }
        }

        // Assign the generated list to the data array
        $data['Inter - Religion'] = array_merge($data['Inter - Religion'], $interReligionCastes);

        // 3. Loop and Insert into Database
        foreach ($data as $religionName => $castes) {
            // Find or Create the religion ID
            // Assuming you have a Religion model with 'name'
            $religion = Religion::firstOrCreate(['name' => $religionName]);

            if ($religion) {
                foreach ($castes as $casteName) {
                    // Create the caste linked to that religion
                    Caste::firstOrCreate([
                        'name' => $casteName,
                        'religion_id' => $religion->id,
                    ]);
                }
            }
        }
    }
}
