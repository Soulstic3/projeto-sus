import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { AntDesign, SimpleLineIcons, Octicons, Ionicons } from '@expo/vector-icons';

import ConsultasScreen from '../consultas';
import PerfilScreen from '../perfil';


const Tab = createBottomTabNavigator();

export default function Home() {
    return (
        <Tab.Navigator screenOptions={{ headerShown: false }}>
            <Tab.Screen name="Minhas Consultas" component={ConsultasScreen} options={{ tabBarIcon: () => <AntDesign name="calendar" size={24} color="black" /> }} />
            <Tab.Screen name="Meu Perfil" component={PerfilScreen} options={{ tabBarIcon: () => <SimpleLineIcons name="user" size={24} color="black" /> }} />
        </Tab.Navigator>
    )
}