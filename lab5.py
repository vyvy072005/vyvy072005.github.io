import matplotlib.pyplot as plt
import numpy as np
from math import *


x = np.array([0.345, 0.761, 1.257, 2.109, 2.943])
y = np.array([-1.221, -0.525, 2.314, 5.106, 9.818])

def accuracy():
    while True:
        try:
            toch = float(input("Введите точность вычислений: "))
            if 0 < toch < 1:
                break
            else:
                print("Некорректный ввод")
        except ValueError:
            print("Некорректный ввод")
    return int(abs(log10(toch))) + 1, toch

def start():
    plt.scatter(x, y, label="Исходные данные")
    plt.xlabel('x')
    plt.ylabel('y')
    plt.title("Исходные данные")
    plt.legend()

def bazis_polinom():
    bazis = []
    for i in range(len(x)):
        b = 1
        for j in range(len(x)):
            if i != j:
                b *= x[i] - x[j]
            bazis.append((1 / b) * y[i])
    return bazis

def Langrange(x0, bazis):
    result = 0
    formula = "L4(x) = "
    for i in range(len(x)):
        row = 1
        s = ""
        for j in range(len(x)):
            if i != j:
                row *= x0 -x[j]
                s += f"(x - {x[j]})"
        result += bazis[i] * row
        formula += f"+{round(bazis[i], kol_zn)} * {s}\n"
    return result, formula

def finite_diff(table, i, j):
    return table[i + 1, j - 1] - table[i, j - 1]

def divided_diff(table, i, j):
    return round((table[i + 1, j - 1] - table[i, j - 1]) / (x[i + j - 1] - x[i]), kol_zn)

def diff_table(diff):
    n = len(y)
    table = np.zeros((n, n + 1))
    table[:, 0] = x
    table[:, 1] = y
    for j in range(2, n + 1):
        for i in range(n - j + 1):
            table[i, j] = diff(table, i, j)
    return table

def Newton(x0, diff):
    result = diff[0]
    formula = f"N4(x) = {diff[0]}"
    for i in range(1, len(diff)):
        row = 1
        s =""
        for j in range(0, i):
            row *= x0 - x[j]
            s += f"(x - {x[j]})"
        result += diff[i] * row
        formula += f"+{round(diff[i], kol_zn)} * {s}\n"
    return result, formula

def lineal_spline(x0):
    result = 0
    formula = f"ф(x) = "
    a = []
    b = []
    for i in range(len(x) - 1):
        a.append((y[i+1]-y[i]) / (x[i+1] - x[i]))
        b.append(y[i] - a[i] * x[i])
    for j in range(len(x) - 1):
        if x[i] <= x0 <= x[i+1]:
            result = a[i] * x0 + b[i]
        formula += f"{round(a[i], kol_zn)} *x+{round(b[i], kol_zn)}, {x[i]} <= x <= {x[i+1]}\n"
    if result == 0:
        print("Точка x0 выходит за границы интерполяционного отрезка")
    return result, formula

def graphic(coeff, name, method):
    x_values = np.linspace(min(x), max(x), 1000)
    y_values = [method(point, coeff)[0] for point in x_values]
    plt.plot(x_values, y_values, label= name)
    plt.title(name)
    start()

def graphic_lineal_spline():
    y_values = [lineal_spline(point)[0] for point in x]
    plt.plot(x, y_values, label="Линейный сплайн")
    plt.title('Линейный сплайн')
    start()

print("Интерполяция таблично заданнных функций")

kol_zn, toch = accuracy()

def main():

    start()
    plt.show()

    while True:
        try:
            x0 = float(input("Введите точку x0 = "))
            break
        except ValueError:
            print("Некорректный ввод точки. Введите число")

    print("Полином Лагранжа")
    bazis = bazis_polinom()
    result_Lagrange, formula_Lagrange = Langrange(x0, bazis)
    print(formula_Lagrange)
    print(f"Значение полинома Лагранжа L4(x0) = {round((result_Lagrange), kol_zn)}")

    print("Таблица конечных разностей")
    finite = diff_table(finite_diff)
    print(finite)

    print("Таблица разделённых разностей")
    divided = diff_table(divided_diff)
    print(divided)

    print("Полином Ньютона")
    diff = divided[0][1:]
    result_Newton, formula_Newton = Newton(x0, diff)
    print(formula_Newton)
    print(f"Значение полинома Ньютона N4(x0) = {round((result_Newton), kol_zn)})")

    print("Линейный сплайн")
    result_lineal_spline, formula_lineal_spline = lineal_spline(x0)
    print(formula_lineal_spline)
    print(f"Значение линейного сплайна ф(x0) = {round(result_lineal_spline, kol_zn)}")

    plt.figure(figsize=[20, 5])
    plt.suptitle('Полученные графики')
    plt.subplot(1, 3, 1)
    graphic(bazis, "Полином Лагранжа", Langrange)
    plt.subplot(1, 3, 2)
    graphic(bazis, "Полином Ньютона", Newton)
    plt.subplot(1, 3, 3)
    graphic_lineal_spline()
    plt.show()


if __name__ == "__main__":
    main()

